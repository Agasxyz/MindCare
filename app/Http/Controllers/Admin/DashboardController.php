<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\Meditasi;
use App\Models\Pertanyaan;
use App\Models\Komentar;

class DashboardController extends Controller
{
    public function index()
    {
        $artikelCount = Artikel::count();
        $paketCount = Meditasi::count();
        $pertanyaanCount = Pertanyaan::count();
        $komentarCount = Komentar::count();

        return view('admin.dashboard', compact('artikelCount', 'paketCount', 'pertanyaanCount', 'komentarCount'));
    }
}
