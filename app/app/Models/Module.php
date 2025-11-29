<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'description',
        'order',
    ];

    // Un módulo pertenece a un curso
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Un módulo tiene muchas lecciones
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}

