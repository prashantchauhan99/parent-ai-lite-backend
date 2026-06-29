<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Homework extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'subject',
        'title',
        'description',
        'assigned_date',
        'due_date',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}