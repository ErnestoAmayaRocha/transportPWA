<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rutasnaranjass extends Model
{
    protected $table = 'rutasnaranjass';

    protected $fillable = [
        'nombre_ruta',
        'costo',
    
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/rutasnaranjasses/'.$this->getKey());
    }
}
