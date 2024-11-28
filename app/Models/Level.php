<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $table = 'levels';  // Pastikan ini sesuai dengan nama tabel
    protected $primaryKey = 'level_id';  // Pastikan sesuai dengan primary key tabel
    protected $fillable = ['level_id', 'level_nama'];  // Nama level dan ID level
}
