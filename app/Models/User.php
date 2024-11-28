<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Menambahkan kolom 'role' dan 'jam_alpa' ke dalam fillable
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',       // Kolom role
        'jam_alpa',   // Kolom jam alpa
    ];

    // Casting untuk memastikan data kolom terkonversi dengan benar
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Menambahkan method untuk cek apakah user adalah mahasiswa
    public function isMahasiswa()
    {
        return $this->role === 'mahasiswa';
    }

    // Menambahkan method untuk cek apakah user adalah dosen/tendik/admin
    public function isDosenOrTendik()
    {
        return in_array($this->role, ['dosen', 'tendik', 'admin']);
    }
}
