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
        'tel',
        'client_id',
        'chauffeur_id',
        'car_id',
        'longitude',
        'latitude',
         'isValid',
         'device_token',
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
    public function scopeNotValid($query)
    {
        return $query->where('isValid', false);
    }
}
