<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoodTracker extends Model
{
    use HasFactory;

    protected $table = 'mood_tracker';
    protected $primaryKey = 'id_mood';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = null;

    protected $fillable = [
        'id_user',
        'mood_value',
        'mood_label',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
