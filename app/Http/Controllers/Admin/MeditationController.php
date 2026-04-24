<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Meditasi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class MeditationController extends Controller
{
    public function index()
    {
        $meditations = Meditasi::all();
        return view('admin.meditation', compact('meditations'));
    }

    public function create()
    {
        return view('admin.meditation-edit', ['meditation' => null]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_meditasi' => 'required',
            'deskripsi' => 'required',
            'kategori' => 'required',
            'gambar' => 'image|nullable',
            'audio' => 'file|mimes:mp3,wav,ogg|nullable',
        ]);

        $data = $request->only(['judul_meditasi', 'deskripsi', 'kategori']);
        $data['id_user'] = Auth::id();

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('meditasi_images', 'public');
            $data['gambar'] = $path;
        } else {
            $data['gambar'] = 'default_meditation.jpg';
        }

        if ($request->hasFile('audio')) {
            $audioPath = $request->file('audio')->store('meditasi_audio', 'public');
            $data['audio'] = $audioPath;
        } else {
            $data['audio'] = 'default.mp3';
        }

        Meditasi::create($data);

        return redirect()->route('admin.meditation')->with('success', 'Meditation created successfully');
    }

    public function edit($id)
    {
        $meditation = Meditasi::findOrFail($id);
        return view('admin.meditation-edit', compact('meditation'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_meditasi' => 'required',
            'deskripsi' => 'required',
            'kategori' => 'required',
            'gambar' => 'image|nullable',
            'audio' => 'file|mimes:mp3,wav,ogg|nullable',
        ]);

        $meditation = Meditasi::findOrFail($id);
        $data = $request->only(['judul_meditasi', 'deskripsi', 'kategori']);

        if ($request->hasFile('gambar')) {
            if ($meditation->gambar && $meditation->gambar != 'default_meditation.jpg') {
                Storage::disk('public')->delete($meditation->gambar);
            }
            $path = $request->file('gambar')->store('meditasi_images', 'public');
            $data['gambar'] = $path;
        }

        if ($request->hasFile('audio')) {
            if ($meditation->audio && $meditation->audio != 'default.mp3') {
                Storage::disk('public')->delete($meditation->audio);
            }
            $audioPath = $request->file('audio')->store('meditasi_audio', 'public');
            $data['audio'] = $audioPath;
        }

        $meditation->update($data);

        return redirect()->route('admin.meditation')->with('success', 'Meditation updated successfully');
    }

    public function destroy($id)
    {
        $meditation = Meditasi::findOrFail($id);
        if ($meditation->gambar && $meditation->gambar != 'default_meditation.jpg') {
            Storage::disk('public')->delete($meditation->gambar);
        }
        if ($meditation->audio && $meditation->audio != 'default.mp3') {
            Storage::disk('public')->delete($meditation->audio);
        }
        $meditation->delete();
        return redirect()->route('admin.meditation')->with('success', 'Meditation deleted successfully');
    }
}
