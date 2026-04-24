<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Goals;
use App\Models\MoodTracker;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Fetch user specific data
        $activeGoals = Goals::where('id_user', $user->id_user)->count();
        $latestMood = MoodTracker::where('id_user', $user->id_user)->latest('created_at')->first();

        return view('user.dashboard', compact('activeGoals', 'latestMood', 'user'));
    }

    public function storeMood(Request $request)
    {
        $request->validate([
            'mood_value' => 'required|integer',
            'mood_label' => 'required|string',
        ]);

        MoodTracker::create([
            'id_user' => Auth::id(),
            'mood_value' => $request->mood_value,
            'mood_label' => $request->mood_label,
        ]);

        return redirect()->back()->with('success', 'Mood kamu berhasil dicatat!');
    }
}
