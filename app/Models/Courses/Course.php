<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'thumbnail',
        'visibility',
    ];

    public function specializations()
    {
        return $this->belongsToMany(Specialization::class)
        ->withPivot(['ordering'])
        ->orderBy('pivot_ordering');
    }

    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail && Storage::exists($this->thumbnail)
        ? Storage::url($this->thumbnail)
        : asset('assets/images/default-image.jpg');
    }
}
