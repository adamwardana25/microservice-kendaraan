<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
  protected $table = 'transactions';

  protected $fillable = [
    'status', 'user_id', 'vehicle_id', 'metadata'
  ];

  protected $casts = [
    'created_at' => 'datetime:Y-m-d H:m:s',
    'updated_at' => 'datetime:Y-m-d H:m:s',
    'metadata' => 'array'
  ];
}
