<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expedition extends Model
{
    use HasFactory;

    protected $primaryKey = 'idexpeditions';

    protected $fillable = [
        'idmoyen',
        'idgestionnaire',
        'idcontainer',
        'datedepart',
        'destination',
    ];

    public function moyen()
    {
        return $this->belongsTo(Moyen::class, 'idmoyen');
    }

    public function gestionnaire()
    {
        return $this->belongsTo(Gestionnaire::class, 'idgestionnaire');
    }

    public function container()
    {
        return $this->belongsTo(Container::class, 'idcontainer');
    }
}
