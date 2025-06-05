<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'ordering',
        'topic_id'
    ];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
