<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komunitas extends Model
{
    use HasFactory;

    protected $table = 'komunitas';
    protected $primaryKey = 'id_post';
    public $timestamps = false; // Schema has created_at but generic timestamp handling might easier if mapped or just disabled and handled manually if needed. 
    // Schema has 'created_at' timestamp default current_timestamp. Eloquent expects created_at and updated_at. 
    // We will disable timestamps and let DB handle created_at, or defining const CREATED_AT = 'created_at'; const UPDATED_AT = null;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = null;

    protected $casts = [
        'created_at' => 'datetime',
    ];

    protected $fillable = [
        'id_user',
        'judul_post',
        'isi_post',
        'likes',
        'total_comments',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function komentar()
    {
        return $this->hasMany(Komentar::class, 'id_post', 'id_post');
    }
}
