<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'title',
        'content',
        'video_url',
        'order',
    ];

    // Una lección pertenece a un módulo
    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
