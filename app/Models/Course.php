<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

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


}
