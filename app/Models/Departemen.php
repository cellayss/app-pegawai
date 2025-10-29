<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    protected $table = 'departments'; // ✅ Ini yang penting
    
    protected $fillable = ['nama_departemen'];

    public function employees()
    {
        return $this->hasMany(Employee::class, 'departemen_id');
    }
}