<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Specialization extends Model
{
    protected $guarded = [];

    protected static function booted(): void
    {
        static::creating(function (Specialization $specialization) {
            if (empty($specialization->uuid)) {
                $specialization->uuid = (string) Str::uuid();
            }
        });
    }

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
