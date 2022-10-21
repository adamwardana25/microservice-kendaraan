<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicles extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('vehicles', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('transportation_type');
      $table->string('thumbnail')->nullable();
      $table->enum('status', ['available', 'booked']);
      $table->integer('price')->default(0)->nullable();
      $table->longText('description')->nullable();
      $table->foreignId('owner_id')->constrained('owners')->onDelete('cascade');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('vehicles');
  }
}
