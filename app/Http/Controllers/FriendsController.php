<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FriendsController extends Controller
{
    public function friendRequests()
    {
        $user = Auth::user();

        // Get friend requests with friendship_status = 2
        $friendRequests = DB::table('friendships')
            ->where('user_id_1', $user->id)
            ->where('friendship_status', 1)
            ->join('users', 'friendships.user_id_2', '=', 'users.id')
            ->select('users.*', 'friendships.friendship_status')
            ->get();

        return $friendRequests;
    }

    public function acceptFriendRequest(Request $request)
    {
        $user = Auth::user();

        // Update friendship status in the database
        DB::table('friendships')
            ->where('user_id_1', $user->id)
            ->where('user_id_2', $request->user_id)
            ->update(['friendship_status' => 2]); // Set to '1' for accepted status

        return response()->json(['message' => 'Friend request accepted']);
    }
}
