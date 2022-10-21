<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageVehicle extends Model
{
  protected $table = 'image_vehicles';

  protected $fillable = [
    'vehicle_id', 'image'
  ];
}
