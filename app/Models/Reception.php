<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reception extends Model
{
    use HasFactory;

    protected $table = 'reception';
    protected $primaryKey = 'idreception';

    protected $fillable = [
        'idgestionnaire',
        'idcargaison',
        'datearrivee',
        'nombrecontainer',
        'lieudereception',
    ];

    public function gestionnaire()
    {
        return $this->belongsTo(Gestionnaire::class, 'idgestionnaire');
    }

    public function cargaison()
    {
        return $this->belongsTo(Cargaison::class, 'idcargaison');
    }
}
