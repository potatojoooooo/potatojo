<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckIn extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'location', 'check_in_notes', 'check_in_time'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
