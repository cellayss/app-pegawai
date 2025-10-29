<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = 'positions'; // ✅ TAMBAHKAN INI - override nama tabel
    
    protected $fillable = [
        'nama_jabatan',
        'gaji_pokok', // ✅ tambahkan gaji_pokok
    ];

    // Relasi ke Employee
    public function employees()
    {
        return $this->hasMany(Employee::class, 'jabatan_id');
    }
}