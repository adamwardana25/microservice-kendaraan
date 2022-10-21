<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
  protected $table = 'vehicles';

  protected $fillable = [
    'name', 'transportation_type', 'thumbnail', 'status', 'price', 'description', 'owner_id'
  ];

  protected $casts = [
    'created_at' => 'datetime:Y-m-d H:m:s',
    'updated_at' => 'datetime:Y-m-d H:m:s'

  ];

  public function owner()
  {
    return $this->belongsTo('App\Model\Owner');
  }

  public function images()
  {
    return $this->hasMany('App\Model\ImageVehicle')->orderBy('id', 'DESCS');
  }
}

// public function up()
//   {
//     Schema::create('vehicles', function (Blueprint $table) {
//       $table->id();
//       $table->string('name');
//       $table->string('transportation_type');
//       $table->string('thumbnail')->nullable();
//       $table->enum('status', ['available', 'booked']);
//       $table->integer('price')->default(0)->nullable();
//       $table->longText('description')->nullable();
//       $table->foreignId('owner_id')->constrained('owners')->onDelete('cascade');
//       $table->timestamps();
//     });
//   }