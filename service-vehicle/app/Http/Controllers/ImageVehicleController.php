<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImageVehicle;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Validator;

class ImageVehicleController extends Controller
{
  public function create(Request $request)
  {
    $rules = [
      'image' => 'required|url',
      'vehicle_id' => 'required|integer'
    ];

    $data = $request->all();

    $validator = Validator::make($data, $rules);

    if ($validator->fails()) {
      return response()->json([
        'status' => 'error',
        'message' => $validator->errors()
      ], 400);
    }

    $vehicleId = $request->input('vehicle_id');
    $vehicle = Vehicle::find($vehicleId);
    if (!$vehicle) {
      return response()->json([
        'status' => 'error',
        'message' => 'vehicle not found'
      ], 400);
    }

    $imageVehicle = ImageVehicle::create($data);
    return response()->json([
      'status' => 'success',
      'data' => $imageVehicle
    ]);
  }

  public function destroy($id)
  {
    $imageVehicle = ImageVehicle::find($id);

    if (!$imageVehicle) {
      return response()->json([
        'status' => 'error',
        'message' => 'image vehicle not found'
      ], 400);
    }

    $imageVehicle->delete();

    return response()->json([
      'status' => 'success',
      'message' => 'image vehicle deleted'
    ]);
  }
}
