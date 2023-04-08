<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
        'matricule',
        'num_assurance',
        'tel',
    ];

    public function cars()
    {
        return $this->hasMany(Car::class);
    }
    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }
}
