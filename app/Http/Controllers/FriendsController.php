<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
            ->where('user_id_2', $user->id)
            ->where('friendship_status', 1)
            ->join('users', 'friendships.user_id_1', '=', 'users.id')
            ->select('users.*', 'friendships.friendship_status')
            ->get();

        return view('friendships.index', compact('friendRequests'));
    }

    public function latest()
    {
        $user = Auth::user();

        // Get friend requests with friendship_status = 2
        $friendRequests = DB::table('friendships')
            ->where('user_id_2', $user->id)
            ->where('friendship_status', 1)
            ->join('users', 'friendships.user_id_1', '=', 'users.id')
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

        return response()->json(['message' => 'Friend request accepted!']);
    }

    public function deleteFriend(Request $request)
    {
        $user = Auth::user();
        $friendUserId = $request->input('user_id');

        // Delete the friendship record where user_id_1 or user_id_2 matches the user's ID
        DB::table('friendships')
            ->where(function ($query) use ($user, $friendUserId) {
                $query->where('user_id_1', $user->id)
                    ->where('user_id_2', $friendUserId);
            })
            ->orWhere(function ($query) use ($user, $friendUserId) {
                $query->where('user_id_1', $friendUserId)
                    ->where('user_id_2', $user->id);
            })
            ->delete();

        return response()->json(['message' => 'Deleted!']);
    }

    public function addFriend(Request $request)
    {
        $user = Auth::user();
        $friendUserId = $request->input('user_id'); // Assuming you receive the user_id of the friend you want to add.

        // Validate the request (you can customize this validation as needed)
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id|not_in:' . $user->id, // Make sure the user_id exists and is not the current user.
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Check if a friendship record already exists (you can customize this logic)
        $existingFriendship = DB::table('friendships')
            ->where(function ($query) use ($user, $friendUserId) {
                $query->where('user_id_1', $user->id)
                    ->where('user_id_2', $friendUserId);
            })
            ->orWhere(function ($query) use ($user, $friendUserId) {
                $query->where('user_id_1', $friendUserId)
                    ->where('user_id_2', $user->id);
            })
            ->first();

        if ($existingFriendship) {
            return response()->json(['message' => 'Friend request already sent or accepted.']);
        }

        // Insert a new friendship record with a pending status (you can customize this status)
        DB::table('friendships')->insert([
            'user_id_1' => $user->id,
            'user_id_2' => $friendUserId,
            'friendship_status' => 1, // Assuming 1 represents a pending request status.
        ]);

        return response()->json(['message' => 'Friend request sent!']);
    }
}
