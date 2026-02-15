<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargaison extends Model
{

    use HasFactory;
    protected $table = 'cargaison';

    protected $primaryKey = 'idcargaison';
    protected $fillable = [
        'nomcargaison',
        'idgestionnaire',
        'naturemarchandise',
        'volumemarchandise',
        'poidscargaison',
        'valeurcargaison',
        'etatcargaison',
    ];

    public function gestionnaire()
    {
        return $this->belongsTo(Gestionnaire::class, 'idgestionnaire');
    }
}
