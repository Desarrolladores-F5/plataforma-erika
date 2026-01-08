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
        'pdf_file',
        'is_preview',
    ];

    // Una lección pertenece a un módulo
    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function completedByUsers()
    {
        return $this->belongsToMany(\App\Models\User::class)
            ->withPivot('completed_at')
            ->withTimestamps();
    }
}
