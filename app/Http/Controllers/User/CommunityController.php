<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Komunitas;
use App\Models\Komentar;

class CommunityController extends Controller
{
    public function index()
    {
        $posts = Komunitas::with(['user', 'komentar.user'])->orderBy('created_at', 'desc')->get();
        return view('user.community', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_post' => 'required',
            'isi_post' => 'required',
        ]);

        Komunitas::create([
            'id_user' => Auth::id(),
            'judul_post' => $request->judul_post,
            'isi_post' => $request->isi_post,
            'likes' => 0,
            'total_comments' => 0,
        ]);

        return redirect()->back()->with('success', 'Post created successfully!');
    }

    public function like($id)
    {
        $post = Komunitas::findOrFail($id);
        $post->increment('likes');
        return redirect()->back();
    }

    public function storeComment(Request $request, $postId)
    {
        $request->validate([
            'isi_komentar' => 'required',
        ]);

        Komentar::create([
            'id_post' => $postId,
            'id_user' => Auth::id(),
            'isi_komentar' => $request->isi_komentar,
        ]);

        $post = Komunitas::findOrFail($postId);
        $post->increment('total_comments');

        return redirect()->back();
    }
}
