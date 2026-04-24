<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Komentar;
use App\Models\Komunitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KomentarController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_post' => 'required|exists:komunitas,id_post',
            'isi_komentar' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $comment = new Komentar();
        $comment->id_post = $request->id_post;
        $comment->id_user = $request->user()->id_user; // Get authenticated user ID
        $comment->isi_komentar = $request->isi_komentar;

        // Handle timestamps manually if model disabled them or rely on default
        // In Komentar model: const CREATED_AT = 'created_at'; const UPDATED_AT = null;
        // Eloquent should handle created_at automatically.

        $comment->save();

        // Increment total_comments in Komunitas
        $post = Komunitas::find($request->id_post);
        if ($post) {
            $post->increment('total_comments');
        }

        return response()->json($comment, 201);
    }
}
