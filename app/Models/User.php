<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'm_user'; // Tabel yang digunakan

    protected $fillable = [
        'username', 'password', 'level_id', 'name', 'alpa_hours'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // Relasi dengan tabel level (admin, dosen, tendik, mahasiswa)
    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }
}