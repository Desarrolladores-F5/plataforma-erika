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
        'price',
        'is_active',
    ];

    // Un curso tiene muchos módulos
    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    // Relación muchos a muchos con usuarios (quienes han comprado el curso)
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}

