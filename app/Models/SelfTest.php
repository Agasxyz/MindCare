<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelfTest extends Model
{
    use HasFactory;

    protected $table = 'self_test';
    protected $primaryKey = 'id_test';
    
    public $timestamps = true;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = null;

    protected $fillable = [
        'id_user',
        'id_meditasi',
        'jawaban',
        'skor',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function meditasi()
    {
        return $this->belongsTo(Meditasi::class, 'id_meditasi', 'id_meditasi');
    }
}
