<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meditasi extends Model
{
    use HasFactory;

    protected $table = 'meditasi';
    protected $primaryKey = 'id_meditasi';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'judul_meditasi',
        'deskripsi',
        'audio',
        'gambar',
        'kategori',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
