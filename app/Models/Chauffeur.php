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

    protected $fillable = ['nom', 'prenom', 'email', 'password', 'tel', 'condition'];

    public function camionRemourquage()
    {
        return $this->hasOne(CamionRemourquage::class);
    }
    public function isChauffeur()
{
    return $this->is_chauffeur;
}
}
