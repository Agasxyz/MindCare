<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pertanyaan;
use App\Models\SelfTest;
use App\Models\Meditasi;

class SelfTestController extends Controller
{
    public function index()
    {
        $questions = Pertanyaan::all();
        return view('user.selftest', compact('questions'));
    }

    public function storeResult(Request $request)
    {
        $request->validate([
            'total_score' => 'required|integer',
            'status' => 'required|string',
        ]);

        $meditasi = Meditasi::first();
        $id_meditasi = $meditasi ? $meditasi->id_meditasi : 1;

        SelfTest::create([
            'id_user' => Auth::id(),
            'id_meditasi' => $id_meditasi,
            'jawaban' => $request->status, // Map to jawaban as previously done
            'skor' => $request->total_score,
            'status' => $request->status, // New dedicated status column
        ]);

        $recommendations = [];
        if (in_array($request->status, ['Sedang', 'Tinggi'])) {
            $recommendations = Meditasi::inRandomOrder()->take(2)->get();
        }

        return response()->json([
            'message' => 'Result saved successfully',
            'recommendations' => $recommendations
        ]);
    }
}
