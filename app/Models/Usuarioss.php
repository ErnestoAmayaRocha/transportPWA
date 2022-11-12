<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuarioss extends Model
{
    protected $table = 'usuarioss';

    protected $fillable = [
        'nombre',
        'correo',
        'telefono',
        'password',
    
    ];
    
    protected $hidden = [
        'password',
    
    ];
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/usuariosses/'.$this->getKey());
    }
}
