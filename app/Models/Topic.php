<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'ordering',
        'specialization_id',
    ];

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('ordering');
    }
}
