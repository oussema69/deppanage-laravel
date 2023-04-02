<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'marque',
        'modele',
        'matricule',
        'num_assurance',
        'date_payment_assurance',
        'date_fin',
        'client_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class,  'client_id');
    }

    public function camionRemourquage()
    {
        return $this->belongsToMany(CamionRemourquage::class);
    }


}
