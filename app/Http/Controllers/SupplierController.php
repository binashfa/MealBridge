<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use Illuminate\Support\Facades\Auth;
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

            ->take(5)

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

        $communitiesHelped = Donation::where(
            'supplier_id',
            $supplier->id
        )

            ->whereNotNull('community_id')

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

        $photo = $request
            ->file('food_photo')
            ->store(
                'donation_photos',
                'public'
            );

        $donation = Donation::create([

            'food_name' => $request->food_name,

            'category' => $request->category,

            'quantity' => $request->quantity,

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
        $histories = Donation::with([
            'community',
            'supplier'
        ])

            ->orderBy('created_at', 'desc')

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

        return redirect('/settings')
            ->with(
                'success',
                'Settings updated successfully'
            );
    }

    public function approveDonation($id)
    {
        $donation = Donation::with([
            'community',
            'supplier'
        ])->findOrFail($id);

        /*
    |--------------------------------------------------------------------------
    | UPDATE STATUS
    |--------------------------------------------------------------------------
    */

        $donation->update([

            'status' => 'distribution'
        ]);

        /*
    |--------------------------------------------------------------------------
    | NOTIFICATION TO COMMUNITY
    |--------------------------------------------------------------------------
    */

        Notification::create([

            'user_id' => $donation
                ->community
                ->user_id,

            'donation_id' => $donation->id,

            'title' => 'Pickup Approved',

            'message' =>

            $donation->supplier->nama_toko .

                ' approved your pickup request for "' .

                $donation->food_name .

                '".',

            'type' => 'approved',

            'is_read' => 0
        ]);

        return back();
    }
}
