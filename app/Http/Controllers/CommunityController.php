<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\Donation;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DonationClaim;

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

        $activePickups = 12;

        $distributedMeals = 540;

        $emergencyRequests = 5;

        return view(
            'community.dashboard',

            compact(
                'user',
                'community',
                'activePickups',
                'distributedMeals',
                'emergencyRequests'
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

        $notification = Notification::latest()->first();

        return view(
            'community.settings',
            compact(
                'user',
                'notification'
            )
        );
    }

    public function updateSettings(Request $request)
    {
        $user = User::find(Auth::id());

        $notification = Notification::latest()->first();

        /*
    |--------------------------------------------------------------------------
    | UPDATE PROFILE
    |--------------------------------------------------------------------------
    */

        if (
            $request->username ||
            $request->email ||
            $request->no_telp
        ) {
            $user->username = $request->username;

            $user->email = $request->email;

            $user->no_telp = $request->no_telp;

            /*
        |--------------------------------------------------------------------------
        | PROFILE PHOTO
        |--------------------------------------------------------------------------
        */

            if ($request->hasFile('profile_photo')) {
                $photo = $request
                    ->file('profile_photo')
                    ->store(
                        'profile_photos',
                        'public'
                    );

                $user->profile_photo = $photo;
            }

            $user->save();
        }

        /*
    |--------------------------------------------------------------------------
    | UPDATE NOTIFICATION
    |--------------------------------------------------------------------------
    */

        if ($request->notification_sound) {
            $notification->update([

                'notification_enabled' =>
                $request->has('notification_enabled'),

                'notification_sound' =>
                $request->notification_sound,

            ]);
        }

        return redirect('/community-settings')
            ->with(
                'success',
                'Settings updated successfully'
            );
    }
}
