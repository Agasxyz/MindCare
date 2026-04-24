<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Komunitas;

class ForumController extends Controller
{
    public function index()
    {
        $posts = Komunitas::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.comment', compact('posts'));
    }

    public function destroy($id)
    {
        $post = Komunitas::findOrFail($id);
        $post->delete();

        return redirect()->route('admin.comment')->with('success', 'Post deleted successfully');
    }
}
