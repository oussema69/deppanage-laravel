<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    protected $fillable = [
        'nbr_personne',
        'type_veh',
        'nom',
        'date',
        'client_id',
        'chauffeur_id',
        'car_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function chauffeur()
    {
        return $this->belongsTo(Chauffeur::class);
    }
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
