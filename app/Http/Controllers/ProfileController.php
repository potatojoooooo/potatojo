<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Interest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $imagePath = null;

        if ($user && $user->image) {
            $imagePath = asset('storage/' . $user->image);
        }

        $interests = Interest::join('user_interests', 'interests.id', '=', 'user_interests.interest_id')
            ->where('user_interests.user_id', $user->id)
            ->get();

        $allInterests = Interest::get();

        return view('profile.edit', [
            'user' => $user,
            'imagePath' => $imagePath,
            'interests' => $interests,
            'allInterests' => $allInterests
        ]);
    }

    public function updateInterests(Request $request)
    {
        $user = $request->user();
        // Validate and update user interests
        $validatedData = $request->validate([
            'interests' => 'array', // Ensure 'interests' is an array
        ]);
        $selectedInterests = $validatedData['interests'];

        $user->interests()->detach();

        // Insert new records into the pivot table
        foreach ($selectedInterests as $interestId) {
            $user->interests()->attach($interestId);
        }

        // Redirect back with a success message or to a confirmation page

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('images', 'public');
            $request->user()->image = $imagePath;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function updateLocationSharing(Request $request)
    {
        $newValue = $request->input('newValue', 0);

        // Retrieve the user
        $user = User::find(auth()->user()->id);

        // Update the allowSharingLocation value
        $user->allow_location_sharing = $newValue;
        $user->save();

        return response()->json(['success' => true]);
    }
}
