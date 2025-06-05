<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    protected $fillable = [
        'title',
        'slug',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class)
        ->withPivot(['ordering'])
        ->orderBy('pivot_ordering');
    }

    public function topics()
    {
        return $this->hasMany(Topic::class)->orderBy('ordering');
    }
}
