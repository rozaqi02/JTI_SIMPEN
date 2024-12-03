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

    protected $table = 'm_user';        //mendefinisikan nama tabel yang digunakan UserModel
    protected $primaryKey = 'id_user';  //mendefinisikan primary key dari tabel yang digunakan
    protected $fillable = [
        'level_id',
        'username',
        'password',
        'foto',
        'created_at',
        'updated_at'
    ];

    protected $hidden = ['password'];

    protected $casts = ['password' => 'hashed'];

    //Relasi tabel m_user ke m_level (many-to-one)
    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }

    //Mendapatkan nama role
    public function getRoleName(): string
    {
        return $this->level->level_nama;
    }

    //Memeriksa bila user memiliki role tertentu
    public function hasRole($role): bool
    {
        return $this->level->level_kode == $role;
    }

    //Mendapatkan kode role
    public function getRole()
    {
        return $this->level->level_kode;
    }
}