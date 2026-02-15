<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    use HasFactory;
    protected $table = 'inspection';
    protected $primaryKey = 'idinspection';
    protected $fillable = [
        'idcargaison',
        'idcontainer',
        'etatinspection',
        'rapport',
        'dateinspection',
        'photo'
    ];

    public function cargaison()
    {
        return $this->belongsTo(Cargaison::class, 'idcargaison');
    }

    public function container()
    {
        return $this->belongsTo(Container::class, 'idcontainer');
    }
}
