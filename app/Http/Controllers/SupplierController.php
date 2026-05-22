<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\DonationClaim;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Notification;

class SupplierController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        $supplier = $user->supplier;

        /*
    |--------------------------------------------------------------------------
    | DONATIONS
    |--------------------------------------------------------------------------
    */

        $donations = Donation::where(
            'supplier_id',
            $supplier->id
        )

            ->latest()

            ->get();

        /*
    |--------------------------------------------------------------------------
    | STATISTICS
    |--------------------------------------------------------------------------
    */

        $totalDonations = Donation::where(
            'supplier_id',
            $supplier->id
        )->count();

        $acceptedDonations = Donation::where(
            'supplier_id',
            $supplier->id
        )

            ->where(
                'status',
                'completed'
            )

            ->count();

        $pendingDonations = Donation::where(
            'supplier_id',
            $supplier->id
        )

            ->where(
                'status',
                'pending'
            )

            ->count();

        $communitiesHelped = DonationClaim::whereHas(
            'donation',
            function ($query) use ($supplier) {

                $query->where(
                    'supplier_id',
                    $supplier->id
                );
            }
        )

            ->distinct()

            ->count('community_id');

        return view(
            'supplier.dashboard',

            compact(
                'supplier',
                'totalDonations',
                'acceptedDonations',
                'pendingDonations',
                'communitiesHelped',
                'donations'
            )
        );
    }
    public function donatePage()
    {
        return view('supplier.donate');
    }

    public function storeDonation(Request $request)
    {
        $request->validate([

            'food_name' => 'required',

            'category' => 'required',

            'quantity' => 'required|numeric',

            'expired_date' => 'required|date',

            'pickup_location' => 'required',

            'pickup_time' => 'required',

            'food_photo' => 'required|image',

            'description' => 'nullable',

        ]);

        /*
    |--------------------------------------------------------------------------
    | UPLOAD PHOTO
    |--------------------------------------------------------------------------
    */

        $photoName = time() . '.' .
            $request->food_photo->extension();

        $request->food_photo->move(
            public_path('donation_photos'),
            $photoName
        );

        $photo = 'donation_photos/' . $photoName;

        $donation = Donation::create([

            'food_name' => $request->food_name,

            'category' => $request->category,

            'quantity' => $request->quantity,

            'remaining_quantity' => $request->quantity,

            'expired_date' => $request->expired_date,

            'pickup_location' => $request->pickup_location,

            'pickup_time' => $request->pickup_time,

            'food_photo' => $photo,

            'description' => $request->description,

            'supplier_name' => Auth::user()->username,

            'supplier_id' => Auth::user()->supplier->id,

        ]);

        Notification::create([

            'user_id' => null,

            'title' => 'New Donation Available',

            'message' =>

            Auth::user()->supplier->nama_toko .

                ' added donation "' .

                $donation->food_name .

                '".',

            'type' => 'new_donation',

            'is_read' => 0
        ]);

        return redirect('/donate')
            ->with(
                'success',
                'Donation successfully added'
            );
    }

    public function notifications()
    {
        $notifications = Notification::where('user_id', Auth::id())

            ->latest()

            ->get();

        return view(
            'supplier.notifications',
            compact('notifications')
        );
    }

    public function history()
    {
        $supplier = Auth::user()->supplier;

        $histories = Donation::with([
            'claims.community',
            'supplier'
        ])

            ->where('supplier_id', $supplier->id)

            ->latest()

            ->paginate(8);

        return view(
            'supplier.history',
            compact('histories')
        );
    }

    public function settings()
    {
        $user = Auth::user();

        $notification = Notification::latest()->first();

        return view(
            'supplier.settings',
            compact(
                'user',
                'notification'
            )
        );
    }

    public function updateSettings(Request $request)
    {
        $request->validate([

            'username' => 'required',

            'email' => 'required|email',

            'no_telp' => 'required'
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // UPDATE DATA
        $user->username = $request->username;
        $user->email = $request->email;
        $user->no_telp = $request->no_telp;

        // PHOTO
        if ($request->hasFile('profile_photo')) {

            $photoName = time() . '.' .
                $request->profile_photo->extension();

            $request->profile_photo->move(
                public_path('profile_photos'),
                $photoName
            );

            $user->profile_photo =
                'profile_photos/' . $photoName;
        }

        $user->save();

        return back()->with(
            'success',
            'Profile updated successfully'
        );
    }

    public function approveDonation($id)
    {
        $claim = DonationClaim::with([
            'donation',
            'community'
        ])->findOrFail($id);

        /*
|--------------------------------------------------------------------------
| UPDATE CLAIM STATUS
|--------------------------------------------------------------------------
*/

        $claim->update([

            'status' => 'approved'

        ]);

        /*
|--------------------------------------------------------------------------
| NOTIFICATION
|--------------------------------------------------------------------------
*/

        Notification::create([

            'user_id' => $claim->community->user_id,

            'title' => 'Pickup Approved',

            'message' =>

            'Your request for "' .

                $claim->donation->food_name .

                '" has been approved.',

            'type' => 'approved',

            'is_read' => 0

        ]);

        return back()->with(
            'success',
            'Claim approved successfully'
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

    public function sendDistribution(Request $request, $id)
    {
        $request->validate([

            'delivery_date' => 'required',

            'courier_name' => 'required',

            'courier_phone' => 'required',

            'supplier_proof_photo' => 'required|image'
        ]);

        $claim = DonationClaim::findOrFail($id);

        /*
    |------------------------------------------------------------------
    | UPLOAD PHOTO
    |------------------------------------------------------------------
    */

        $photoName = time() . '.' .
            $request->supplier_proof_photo->extension();

        $request->supplier_proof_photo->move(
            public_path('distribution_photos'),
            $photoName
        );

        /*
    |------------------------------------------------------------------
    | UPDATE CLAIM
    |------------------------------------------------------------------
    */

        $claim->update([

            'delivery_date' =>
            $request->delivery_date,

            'courier_name' =>
            $request->courier_name,

            'courier_phone' =>
            $request->courier_phone,

            'supplier_proof_photo' =>
            'distribution_photos/' . $photoName,

            'status' => 'distribution'
        ]);

        return back()->with(
            'success',
            'Distribution started successfully'
        );
    }
}
