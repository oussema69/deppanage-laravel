<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CamionRemourquageCar extends Model
{
    use HasFactory;

    protected $table = 'camion_remourquage_car';
    protected $primaryKey = null; // Set primary key to null to indicate composite key

    protected $fillable = [
        'camion_remourquage_id',
        'car_id',
        'etat',
        'occurrence',
    ];

    public function camionRemourquage()
    {
        return $this->belongsTo(CamionRemourquage::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public static function getCarsByTruckId($id)
    {
        return self::where('camion_remourquage_id', $id)->with('car')->get()->pluck('car');
    }

    public function incrementOccurrence()
    {
        $this->occurrence = $this->occurrence + 1;
        $this->save();
        
        // Update the primary key columns
        $this->update([
            'camion_remourquage_id' => $this->camion_remourquage_id,
            'car_id' => $this->car_id
        ]);
    }
    
}
