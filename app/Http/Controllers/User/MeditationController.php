<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Meditasi;

class MeditationController extends Controller
{
    public function index()
    {
        $meditations = Meditasi::all();
        return view('user.meditation', compact('meditations'));
    }

    public function play($id)
    {
        $meditation = Meditasi::findOrFail($id);
        return view('user.meditation-play', compact('meditation'));
    }
}
