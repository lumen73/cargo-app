<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    use HasFactory;

    protected $table = 'container';
    protected $primaryKey = 'idcontainer';

    protected $fillable = [
        'numerocontainer',
        'taillecontainer',
        'typecargaison',
        'paysorigine',
        'destination',
        'poidscontainer',
        'datearrivee',
        'etatinspection',
        'idcargaison',
    ];

    // Relation avec la table cargaison
    public function cargaison()
    {
        return $this->belongsTo(Cargaison::class, 'idcargaison');
    }
}
