<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alpa extends Model
{
    protected $table = 't_periode_alpa';

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }
}
