<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artikel;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Artikel::all();
        return view('user.article', compact('articles'));
    }

    public function show($id)
    {
        $article = Artikel::findOrFail($id);
        return view('user.article-detail', compact('article'));
    }
}
