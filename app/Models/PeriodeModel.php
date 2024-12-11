<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodeModel extends Model
{
    use HasFactory;

    protected $table = 't_periode'; // Nama tabel periode
    protected $primaryKey = 'id_periode'; // Pastikan primary key yang digunakan benar
    public $incrementing = true; // Jika primary key bertipe auto-increment
    protected $keyType = 'int'; // Jika primary key adalah integer

    protected $fillable = [
        'nama_periode', // Kolom nama periode sesuai dengan struktur tabel di migrasi
    ];

    public function alpaku()
    {
        return $this->hasMany(AlpakuModel::class, 'id_periode', 'id_periode'); // Relasi one-to-many
    }
}
