<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Course;


class User extends Authenticatable
{
    // ✅ Roles del sistema (valores técnicos en DB)
    public const ROLE_ADMIN   = 'admin';
    public const ROLE_STUDENT = 'student';   
    
    
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',

        // extras de perfil
        'first_name',
        'last_name',
        'gender',        // 'f','m','nb','otro','pref'
        'birth_date',    // DATE
        'address',
        'comuna',
        'phone',

        // identidad/rol
        'rut',
        'rut_verified',
        'role',          // 'admin' | 'student'

        // verificación/cookies
        'email_verified_at',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'birth_date'        => 'date',     // para manejarla como Carbon
            'rut_verified'      => 'boolean',  // 0/1 -> bool
            'password'          => 'hashed',   // hash automático
        ];
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    // Un usuario puede tener muchas órdenes
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isStudent()
    {
        return $this->role === self::ROLE_STUDENT;
    }

}
