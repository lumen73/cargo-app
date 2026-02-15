<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moyen extends Model
{
    protected $primaryKey = 'idmoyen';
    protected $table = 'moyen';
    protected $fillable = [
        'transport',
        'nomchauffeur',
        'prenomschauffeur',
        'numero',
        'permis',
    ];
}
