<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\Donation;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\User;

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

    public function claimDonation($id)
    {
        $donation = Donation::with('supplier')
            ->findOrFail($id);

        $community = Auth::user()->community;

        /*
    |--------------------------------------------------------------------------
    | STATUS REQUESTED
    |--------------------------------------------------------------------------
    */

        $donation->update([

            'status' => 'requested',

            'community_id' => $community->id
        ]);

        /*
    |--------------------------------------------------------------------------
    | NOTIF TO SUPPLIER
    |--------------------------------------------------------------------------
    */

        Notification::create([

            'user_id' => $donation->supplier->user_id,

            'title' => 'Pickup Request',

            'message' =>

            $community->nama_komunitas .

                ' wants to claim "' .

                $donation->food_name .

                '".',

            'type' => 'pickup_request',

            'is_read' => 0
        ]);

        return back();
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

        $donation = Donation::with([
            'supplier',
            'community'
        ])

            ->findOrFail($id);

        /*
    |--------------------------------------------------------------------------
    | UPLOAD PROOF PHOTO
    |--------------------------------------------------------------------------
    */

        $proofPhoto = $request
            ->file('proof_photo')
            ->store(
                'proof_photos',
                'public'
            );

        /*
    |--------------------------------------------------------------------------
    | UPDATE STATUS
    |--------------------------------------------------------------------------
    */

        $donation->update([

            'status' => 'completed',

            'proof_photo' => $proofPhoto
        ]);

        /*
    |--------------------------------------------------------------------------
    | NOTIFICATION TO SUPPLIER
    |--------------------------------------------------------------------------
    */

        Notification::create([

            'user_id' => $donation->supplier->user_id,

            'title' => 'Donation Delivered',

            'message' =>

            '"' .

                $donation->food_name .

                '" has been successfully received by ' .

                $donation->community->nama_komunitas .

                '.',

            'type' => 'completed',

            'is_read' => 0
        ]);

        return back();
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

        $histories = Donation::with([
            'supplier',
            'community'
        ])

            ->where('community_id', $community->id)

            ->whereIn('status', [
                'requested',
                'distribution',
                'completed'
            ])

            ->orderBy('created_at', 'desc')

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
