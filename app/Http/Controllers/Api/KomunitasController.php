<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Komunitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KomunitasController extends Controller
{
    public function index()
    {
        // Eager load user and count comments
        $posts = Komunitas::with('user')->get();
        return response()->json($posts);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul_post' => 'required|string|max:255',
            'isi_post' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $post = new Komunitas();
        $post->id_user = $request->user()->id_user;
        $post->judul_post = $request->judul_post;
        $post->isi_post = $request->isi_post;
        $post->likes = 0;
        $post->total_comments = 0;
        $post->save();

        return response()->json($post, 201);
    }

    public function show($id)
    {
        $post = Komunitas::with(['user', 'komentar.user'])->find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        return response()->json($post);
    }
}
