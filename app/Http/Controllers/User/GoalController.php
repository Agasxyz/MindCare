<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Goals;

class GoalController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $activeGoals = Goals::where('id_user', $user->id_user)
                            ->where('status', 'active')
                            ->get();
        $completedGoals = Goals::where('id_user', $user->id_user)
                               ->where('status', 'completed')
                               ->get();
        return view('user.goals', compact('activeGoals', 'completedGoals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_goals' => 'required',
            'isi_goals' => 'required',
            'tanggal_start' => 'required|date',
            'tanggal_target' => 'required|date|after_or_equal:tanggal_start',
        ]);

        Goals::create([
            'id_user' => Auth::id(),
            'judul_goals' => $request->judul_goals,
            'isi_goals' => $request->isi_goals,
            'tanggal_start' => $request->tanggal_start,
            'tanggal_target' => $request->tanggal_target,
            'status' => 'active',
        ]);

        return redirect()->back()->with('success', 'Goal created successfully!');
    }

    public function update(Request $request, $id)
    {
        $goal = Goals::where('id_user', Auth::id())->where('id_goals', $id)->firstOrFail();
        
        // Simple toggle or explicit set? Assuming user wants to mark as completed.
        // If already completed, maybe move back? Let's assume one-way move or toggle.
        // User request: "when user finishes goals, move to completed section".
        
        $goal->status = 'completed';
        $goal->save();

        return redirect()->back()->with('success', 'Goal marked as completed!');
    }

    public function destroy($id)
    {
        $goal = Goals::where('id_user', Auth::id())->where('id_goals', $id)->firstOrFail();
        $goal->delete();
        return redirect()->back()->with('success', 'Goal deleted successfully!');
    }
}
