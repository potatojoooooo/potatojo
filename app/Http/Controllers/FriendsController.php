<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FriendsController extends Controller
{
    public function friendships()
    {
        $user = Auth::user();

        $friendships = DB::table('friendships')
            ->where('user_id_1', $user->id)
            ->where('friendship_status', 2) // Accepted status
            ->join('users', 'friendships.user_id_2', '=', 'users.id')
            ->select('users.id', 'users.name', 'users.bio', 'users.image') // Select the desired fields
            ->get();

        // Retrieve image paths for all friends
        foreach ($friendships as $friendship) {
            $friendship->imagePath = asset('storage/' . $friendship->image);
        }

        return $friendships;
    }


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

        return view('friendships.index', compact('friendRequests'));
    }

    public function latest()
    {
        $user = Auth::user();

        // Get friend requests with friendship_status = 2
        $friendRequests = DB::table('friendships')
            ->where('user_id_1', $user->id)
            ->where('friendship_status', 1)
            ->join('users', 'friendships.user_id_2', '=', 'users.id')
            ->select('users.*', 'friendships.friendship_status', 'users.image as user_image') // Select the user's image column as 'user_image'
            ->take(3)
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
            ->update(['friendship_status' => 2]);

        return response()->json(['message' => 'Friend request accepted']);
    }

    public function deleteFriend(Request $request)
    {
        $user = Auth::user();

        // Delete the friendship record
        DB::table('friendships')
            ->where('user_id_1', $user->id)
            ->where('user_id_2', $request->user_id)
            ->delete();

        return response()->json(['message' => 'Friend request removed']);
    }
}
