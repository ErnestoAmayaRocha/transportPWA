<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recorridos extends Model
{
    use HasFactory;
    
    public function usuarios()
    {
        return $this->hasMany(Usuarios::class);
    }

    public function rutas()
    {
        return $this->hasMany(Rutas::class);
    }
}
