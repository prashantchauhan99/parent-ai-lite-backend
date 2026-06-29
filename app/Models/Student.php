<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'class_name',
        'section_name',
        'date_of_birth',
        'admission_number',
    ];

    public function parents(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'parent_student');
    }

    public function homeworks(): HasMany
    {
        return $this->hasMany(Homework::class);
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }
}