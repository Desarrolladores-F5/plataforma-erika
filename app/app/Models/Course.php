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
        'is_published',
        'thumbnail',            // Nuevo
        'banner_url',           // Nuevo
        'promo_video_url',      // Nuevo
    ];

    // Un curso tiene muchos módulos
    public function modules()
    {
        return $this->hasMany(\App\Models\Module::class)->orderBy('order');
    }

    // Relación muchos a muchos con usuarios (quienes han comprado el curso)
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}

