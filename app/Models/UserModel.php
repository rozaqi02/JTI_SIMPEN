<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UserModel extends Authenticatable 
{
    //use HasFactory;

    protected $table = 'm_user';        // mendefinisikan nama tabel yang digunakan UserModel
    protected $primaryKey = 'id_user';  // mendefinisikan primary key dari tabel yang digunakan
    protected $fillable = [
        'level_id',
        'username',
        'password',
        'foto',
    ];

    protected $hidden = ['password'];

    protected $casts = ['password' => 'hashed'];

    // Relasi tabel m_user ke m_level (many-to-one)
    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'level_id');
    }

    // Mendapatkan nama role
    public function getRoleName(): string
    {
        return $this->level->level_nama;
    }

    // Memeriksa bila user memiliki role tertentu
    public function hasRole($role): bool
    {
        return $this->level->level_kode == $role;
    }

    // Mendapatkan foto profile sesuai dengan role
    public function getProfilePhoto()
    {
        $levelCode = $this->getRole();
        
        switch ($levelCode) {
            case 'MHS': // Mahasiswa
                return MahasiswaModel::find($this->id_user)->foto ?? null;
            case 'DSN': // Dosen
                return DosenModel::find($this->id_user)->foto ?? null;
            case 'ADM': // Admin
                return AdminModel::find($this->id_user)->foto ?? null;
            case 'TDK': // Tendik
                return TendikModel::find($this->id_user)->foto ?? null;
            default:
                return null; // jika tidak ada foto, kembalikan null
        }
    }

    // Relasi dengan Mahasiswa
    public function mahasiswa()
    {
        return $this->hasOne(MahasiswaModel::class, 'id_user', 'id_user');
    }

    // Relasi dengan Dosen
    public function dosen()
    {
        return $this->hasOne(DosenModel::class, 'id_user', 'id_user');
    }

    // Relasi dengan Admin
    public function admin()
    {
        return $this->hasOne(AdminModel::class, 'id_user', 'id_user');
    }

    // Relasi dengan Tendik
    public function tendik()
    {
        return $this->hasOne(TendikModel::class, 'id_user', 'id_user');
    }

    // Mendapatkan kode role
    public function getRole()
    {
        return $this->level->level_kode;
    }
}
