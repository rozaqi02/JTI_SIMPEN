<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TugasModel extends Model
{
    protected $table = 'm_tugas';

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }
}
