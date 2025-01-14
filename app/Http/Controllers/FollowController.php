<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function follow(User $user)
    {
        $currentUser = Auth::user();
        if (!$currentUser->follows()->where('followed_user_id', $user->id)->exists()) {
            $currentUser->follows()->attach($user->id);
            return response()->json(['message' => 'User followed successfully']);
        }
        return response()->json(['message' => 'User already followed'], 400);
    }

    public function unfollow(User $user)
    {
        $currentUser = Auth::user();
        if ($currentUser->follows()->where('followed_user_id', $user->id)->exists()) {
            $currentUser->follows()->detach($user->id);
            return response()->json(['message' => 'User unfollowed successfully']);
        }
        return response()->json(['message' => 'User not followed'], 400);
    }
}