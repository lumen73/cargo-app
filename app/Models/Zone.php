<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;
    protected $table = 'zone';
    protected $primaryKey = 'idzone';

    protected $fillable = [
        'idcontainer',
        'zonestockage',
        'datestockage',
        'heurestockage',
    ];

    public function container()
    {
        return $this->belongsTo(Container::class, 'idcontainer');
    }
}
