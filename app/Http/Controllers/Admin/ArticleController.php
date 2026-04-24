<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artikel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Artikel::all();
        return view('admin.article', compact('articles'));
    }

    public function create()
    {
        return view('admin.article-edit', ['article' => null]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_artikel' => 'required',
            'isi_artikel' => 'required',
            'gambar' => 'image|nullable',
        ]);

        $data = $request->only(['judul_artikel', 'isi_artikel']);
        $data['id_user'] = Auth::id(); // Admin ID

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('artikel_images', 'public');
            $data['gambar'] = $path;
        } else {
             $data['gambar'] = 'default.jpg'; // Placeholder
        }

        Artikel::create($data);

        return redirect()->route('admin.article')->with('success', 'Article created successfully');
    }

    public function edit($id)
    {
        $article = Artikel::findOrFail($id);
        return view('admin.article-edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_artikel' => 'required',
            'isi_artikel' => 'required',
            'gambar' => 'image|nullable',
        ]);

        $article = Artikel::findOrFail($id);
        $data = $request->only(['judul_artikel', 'isi_artikel']);

        if ($request->hasFile('gambar')) {
            // Delete old image if exists and not default
            if ($article->gambar && $article->gambar != 'default.jpg') {
                Storage::disk('public')->delete($article->gambar);
            }
            $path = $request->file('gambar')->store('artikel_images', 'public');
            $data['gambar'] = $path;
        }

        $article->update($data);

        return redirect()->route('admin.article')->with('success', 'Article updated successfully');
    }

    public function destroy($id)
    {
        $article = Artikel::findOrFail($id);
         if ($article->gambar && $article->gambar != 'default.jpg') {
                Storage::disk('public')->delete($article->gambar);
        }
        $article->delete();
        return redirect()->route('admin.article')->with('success', 'Article deleted successfully');
    }
}
