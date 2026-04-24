<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MoodTracker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MoodTrackerController extends Controller
{
    public function index(Request $request)
    {
        $moods = MoodTracker::where('id_user', $request->user()->id_user)
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->json($moods);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mood_value' => 'required|integer',
            'mood_label' => 'sometimes|string|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $mood = new MoodTracker();
        $mood->id_user = $request->user()->id_user;
        $mood->mood_value = $request->mood_value;
        $mood->mood_label = $request->mood_label;
        $mood->save();

        return response()->json($mood, 201);
    }
}
