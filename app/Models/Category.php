<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function interests()
    {
        return $this->hasMany(Interest::class);
    }

    public function events()
    {
        return $this->hasOne(Event::class);
    }
}
