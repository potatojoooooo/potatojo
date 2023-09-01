<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_interests');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
