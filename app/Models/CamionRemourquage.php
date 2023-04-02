<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CamionRemourquage extends Model
{
    use HasFactory;

    protected $table = 'camion_remourquage';

    protected $fillable = [
        'matricule',
        'model',
        'etat',
    ];

    public function cars()
    {
        return $this->belongsToMany(Car::class)->using(CamionRemourquageCar::class);
    }

    public function chauffeur()
    {
        return $this->belongsTo(Chauffeur::class);
    }
}






