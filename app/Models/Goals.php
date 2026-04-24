<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goals extends Model
{
    use HasFactory;

    protected $table = 'goals';
    protected $primaryKey = 'id_goals';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'judul_goals',
        'isi_goals',
        'tanggal_start',
        'tanggal_target',
        'status',
    ];

    protected $casts = [
        'tanggal_start' => 'date',
        'tanggal_target' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
