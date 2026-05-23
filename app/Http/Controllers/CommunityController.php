<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\Donation;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DonationClaim;
use Illuminate\Support\Facades\Hash;
use App\Models\Community;

class CommunityController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    public function dashboard()
    {
        $user = Auth::user();

        $community = $user->community;

        /*
    |--------------------------------------------------------------------------
    | ACTIVE PICKUPS
    |--------------------------------------------------------------------------
    */

        $activePickups = DonationClaim::where(
            'community_id',
            $community->id
        )

            ->whereIn('status', [
                'requested',
                'distribution'
            ])

            ->count();

        /*
    |--------------------------------------------------------------------------
    | MEALS DISTRIBUTED
    |--------------------------------------------------------------------------
    */

        $distributedMeals = DonationClaim::where(
            'community_id',
            $community->id
        )

            ->where(
                'status',
                'completed'
            )

            ->sum('claimed_quantity');

        /*
    |--------------------------------------------------------------------------
    | EMERGENCY REQUESTS
    |--------------------------------------------------------------------------
    */

        $emergencyRequests = Donation::where(
            'status',
            'pending'
        )

            ->whereDate(
                'expired_date',
                '<=',
                now()->addDay()
            )

            ->count();

        /*
    |--------------------------------------------------------------------------
    | AVAILABLE DONATIONS
    |--------------------------------------------------------------------------
    */

        $availableDonations = Donation::with('supplier')

            ->where('status', 'pending')

            ->where('remaining_quantity', '>', 0)

            ->latest()

            ->take(3)

            ->get();

        /*
    |--------------------------------------------------------------------------
    | ACTIVE DISTRIBUTION
    |--------------------------------------------------------------------------
    */

        $activeDistribution = DonationClaim::with([
            'donation.supplier'
        ])

            ->where(
                'community_id',
                $community->id
            )

            ->where(
                'status',
                'distribution'
            )

            ->latest()

            ->first();

        /*
    |--------------------------------------------------------------------------
    | COMPLETED DISTRIBUTIONS
    |--------------------------------------------------------------------------
    */

        $completedDistributions = DonationClaim::where(
            'community_id',
            $community->id
        )

            ->where(
                'status',
                'completed'
            )

            ->count();

        $totalClaimed = DonationClaim::where(
            'community_id',
            $community->id
        )

            ->whereIn('status', [
                'requested',
                'approved',
                'distribution',
                'completed'
            ])

            ->sum('claimed_quantity');

        $remainingLimit = 30 - $totalClaimed;

        $progress = ($totalClaimed / 30) * 100;

        return view(
            'community.dashboard',

            compact(
                'user',
                'community',
                'activePickups',
                'distributedMeals',
                'emergencyRequests',
                'availableDonations',
                'activeDistribution',
                'completedDistributions',
                'remainingLimit',
                'totalClaimed',
                'progress'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | AVAILABLE DONATIONS
    |--------------------------------------------------------------------------
    */

    public function donations()
    {

        $user = Auth::user();

        $community = $user->community;

        $donations = Donation::with('supplier')

            ->where('status', 'pending')

            ->latest()

            ->paginate(12);

        return view(

            'community.donations',

            compact(
                'user',
                'community',
                'donations'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CLAIM DONATION
    |--------------------------------------------------------------------------
    */

    public function claimDonation(Request $request, $id)
    {
        $request->validate([

            'claim_quantity' => 'required|numeric|min:1'
        ]);

        $donation = Donation::with('supplier')
            ->findOrFail($id);

        $community = Auth::user()->community;

        /*
    |--------------------------------------------------------------------------
    | CHECK REMAINING
    |--------------------------------------------------------------------------
    */

        if (
            $request->claim_quantity >
            $donation->remaining_quantity
        ) {

            return back()->with(
                'error',
                'Not enough remaining portions'
            );
        }

        /*
    |--------------------------------------------------------------------------
    | TOTAL CLAIMED
    |--------------------------------------------------------------------------
    */

        $totalPortions = DonationClaim::where(
            'community_id',
            $community->id
        )

            ->whereIn('status', [
                'requested',
                'approved'
            ])

            ->sum('claimed_quantity');

        /*
|--------------------------------------------------------------------------
| LIMIT 30
|--------------------------------------------------------------------------
*/

        if (
            ($totalPortions + $request->claim_quantity) > 30
        ) {

            return back()->with(
                'error',
                'Maximum claim limit is 30 portions'
            );
        }

        /*
|--------------------------------------------------------------------------
| CHECK DUPLICATE CLAIM
|--------------------------------------------------------------------------
*/

        $existingClaim = DonationClaim::where(
            'donation_id',
            $donation->id
        )

            ->where(
                'community_id',
                $community->id
            )

            ->whereIn('status', [
                'requested',
                'approved'
            ])

            ->first();

        if ($existingClaim) {

            return back()->with(
                'error',
                'You already claimed this donation'
            );
        }

        /*
|--------------------------------------------------------------------------
| CREATE CLAIM
|--------------------------------------------------------------------------
*/

        DonationClaim::create([

            'donation_id' => $donation->id,

            'community_id' => $community->id,

            'claimed_quantity' => $request->claim_quantity,

            'status' => 'requested'

        ]);

        /*
|--------------------------------------------------------------------------
| REDUCE REMAINING
|--------------------------------------------------------------------------
*/

        $donation->remaining_quantity -=
            $request->claim_quantity;

        /*
|--------------------------------------------------------------------------
| IF EMPTY
|--------------------------------------------------------------------------
*/

        if ($donation->remaining_quantity <= 0) {

            $donation->remaining_quantity = 0;

            $donation->status = 'completed';
        }

        $donation->save();

        /*
    |--------------------------------------------------------------------------
    | NOTIFICATION
    |--------------------------------------------------------------------------
    */

        Notification::create([

            'user_id' => $donation->supplier->user_id,

            'title' => 'Pickup Request',

            'message' =>

            $community->nama_komunitas .

                ' claimed ' .

                $request->claim_quantity .

                ' portions of "' .

                $donation->food_name .

                '".',

            'type' => 'pickup_request',

            'is_read' => 0
        ]);

        return back()->with(
            'success',
            'Donation claimed successfully'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | COMPLETE DELIVERY
    |--------------------------------------------------------------------------
    */

    public function completeDonation(Request $request, $id)
    {
        $request->validate([

            'proof_photo' => 'required|image'
        ]);

        $claim = DonationClaim::findOrFail($id);

        /*
    |--------------------------------------------------------------------------
    | UPLOAD PHOTO
    |--------------------------------------------------------------------------
    */

        $photoName = time() . '.' .
            $request->proof_photo->extension();

        $request->proof_photo->move(
            public_path('completion_photos'),
            $photoName
        );

        /*
    |--------------------------------------------------------------------------
    | UPDATE CLAIM
    |--------------------------------------------------------------------------
    */

        $claim->update([

            'community_proof_photo' =>
            'completion_photos/' . $photoName,

            'status' => 'completed'
        ]);

        return back()->with(
            'success',
            'Donation completed successfully'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | NOTIFICATIONS
    |--------------------------------------------------------------------------
    */

    public function notifications()
    {
        $notifications = Notification::where(function ($query) {

            $query

                ->whereNull('user_id')

                ->orWhere(
                    'user_id',
                    Auth::id()
                );
        })

            ->latest()

            ->get();

        return view(
            'community.notifications',
            compact('notifications')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | HISTORY
    |--------------------------------------------------------------------------
    */

    public function history()
    {
        $user = Auth::user();

        $community = $user->community;

        $histories = DonationClaim::with([
            'donation.supplier',
            'community'
        ])

            ->where(
                'community_id',
                $community->id
            )

            ->whereIn('status', [
                'requested',
                'distribution',
                'completed'
            ])

            ->latest()

            ->paginate(6);

        return view(
            'community.history',

            compact(
                'user',
                'community',
                'histories'
            )
        );
    }

    public function settings()
    {
        $user = Auth::user();

        $community = Community::firstOrCreate(

            [
                'user_id' => $user->id
            ],

            [
                'nama_komunitas' => '',
                'tujuan_komunitas' => '',
                'alamat_komunitas' => ''
            ]
        );

        $notification = Notification::latest()->first();

        return view(
            'community.settings',

            compact(
                'user',
                'community',
                'notification'
            )
        );
    }

    public function updateSettings(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $community = Community::firstOrCreate(

            [
                'user_id' => $user->id
            ],

            [
                'nama_komunitas' => '',
                'tujuan_komunitas' => '',
                'alamat_komunitas' => ''
            ]
        );

        /*
    |--------------------------------------------------------------------------
    | VALIDATION
    |--------------------------------------------------------------------------
    */
    
    $request->validate([

            'username' => 'required|max:255|unique:users,username,' . $user->id,

            'email' => 'required|email|max:255|unique:users,email,' . $user->id,

            'no_telp' => 'required|max:20',

            'nama_komunitas' => 'required|max:255',

            'tujuan_komunitas' => 'required|max:250',

            'alamat_komunitas' => 'required',

            'latitude' => 'nullable',

            'longitude' => 'nullable',

            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        /*
    |--------------------------------------------------------------------------
    | UPDATE USERS TABLE
    |--------------------------------------------------------------------------
    */

        $dataUser = [

            'username' => $request->username,

            'email' => $request->email,

            'no_telp' => $request->no_telp,
        ];

        if ($request->hasFile('profile_photo')) {

            $photoName = time() . '.' .
                $request->profile_photo->extension();

            $request->profile_photo->move(
                public_path('profile_photos'),
                $photoName
            );

            $dataUser['profile_photo'] =
                'profile_photos/' . $photoName;
        }

        $user->update($dataUser);

        /*
    |--------------------------------------------------------------------------
    | UPDATE COMMUNITIES TABLE
    |--------------------------------------------------------------------------
    */

        $community->update([

            'nama_komunitas' =>
            $request->nama_komunitas,

            'tujuan_komunitas' =>
            $request->tujuan_komunitas,

            'alamat_komunitas' =>
            $request->alamat_komunitas,

            'latitude' =>
            $request->latitude,

            'longitude' =>
            $request->longitude,
        ]);

        return back()->with(
            'success',
            'Profile updated successfully'
        );
    }

    public function updatePassword(Request $request)
    {
        $request->validate([

            'current_password' => 'required',

            'new_password' => 'required|min:6|confirmed'
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // CHECK PASSWORD
        if (!Hash::check(
            $request->current_password,
            $user->password
        )) {

            return back()->with(
                'error',
                'Current password is incorrect'
            );
        }

        // UPDATE
        $user->password = Hash::make(
            $request->new_password
        );

        $user->save();

        return back()->with(
            'success',
            'Password updated successfully'
        );
    }
}
