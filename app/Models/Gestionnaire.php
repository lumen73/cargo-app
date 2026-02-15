<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Gestionnaire extends Model
{
    use HasFactory;

    protected $fillable = ['idusers', 'cargaison'];

    public function receptions()
    {
        return $this->hasMany(Reception::class, 'idgestionnaire');
    }
    public function cargaison()
    {
        return $this->hasMany(Cargaison::class, 'idgestionnaire');
    }

    /*
    public function user()
    {
        return $this->belongsTo(User::class, 'idusers');
        $gestionnaires = User::where('role', 'gestionnaire')
            ->whereHas('gestionnaire')
            ->get();
    }*/

    protected $table = 'gestionnaire';
    protected $primaryKey = 'idgestionnaire';

    public function user()
    {
        return $this->belongsTo(User::class, 'idusers');  // Indique que chaque gestionnaire appartient à un utilisateur
    }
}
