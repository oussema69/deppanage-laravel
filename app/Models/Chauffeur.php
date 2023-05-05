<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Chauffeur extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = ['nom', 'prenom', 'email', 'password', 'tel', 'condition','camion_remorquage_id',"device_token"];
  
    public function camionRemourquage()
    {
        return $this->hasOne(CamionRemourquage::class);
    }
    public function isChauffeur()
{
    return $this->is_chauffeur;
}
public function demandes()
{
    return $this->hasMany(Demande::class);
}
public static function getConditionChauffeurs()
{
    return static::where('condition', true)->get();
}
}
