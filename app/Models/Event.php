<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $fillable = [
        'name',
        'description',
        'location',
        'city',
        'date',
        'start_time',
        'end_time',
        'longitude',
        'latitude',
        'participants_needed',
        'category_id',
        'user_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'event_participants')
            ->withPivot('participation_status');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
