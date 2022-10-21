<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
  public function index(Request $request)
  {
    $vehicles = Vehicle::query();

    $q = $request->query('q');
    $status = $request->query('status');

    $vehicles->when($q, function ($query) use ($q) {
      return $query->whereRaw("name LIKE '%" . strtolower($q) . "%'");
    });

    $vehicles->when($status, function ($query) use ($status) {
      return $query->where('status', '=', $status);
    });

    return response()->json([
      'status' => 'success',
      'data' => $vehicles->paginate(10)
    ]);
  }

  public function show($id)
  {
    $vehicle = Vehicle::find($id);
    if (!$vehicle) {
      return response()->json([
        'status' => 'error',
        'message' => 'owner not found'
      ], 404);
    }

    return response()->json([
      'status' => 'success',
      'data' => $vehicle
    ]);
  }

  public function create(Request $request)
  {
    $rules = [
      'name' => 'required|string',
      'transportation_type' => 'required|string',
      'thumbnail' => 'string|url',
      'status' => 'required|in:available,booked',
      'price' => 'integer',
      'description' => 'string',
      'owner_id' => 'required|integer',
    ];

    $data = $request->all();

    $validator = Validator::make($data, $rules);

    if ($validator->fails()) {
      return response()->json([
        'status' => 'error',
        'message' => $validator->errors()
      ], 400);
    }

    $ownerId = $request->input('owner_id');
    $owner = Owner::find($ownerId);
    if (!$owner) {
      return response()->json([
        'status' => 'error',
        'message' => 'owner not found'
      ], 400);
    }

    $vehicle = Vehicle::create($data);
    return response()->json([
      'status' => 'succes',
      'data' => $vehicle
    ]);
  }


  public function update(Request $request, $id)
  {
    $rules = [
      'name' => 'string',
      'transportation_type' => 'string',
      'thumbnail' => 'string|url',
      'status' => 'in:available,booked',
      'price' => 'integer',
      'description' => 'string',
      'owner_id' => 'integer',
    ];

    $data = $request->all();

    $validator = Validator::make($data, $rules);

    if ($validator->fails()) {
      return response()->json([
        'status' => 'error',
        'message' => $validator->errors()
      ], 400);
    }

    $vehicle = Vehicle::find($id);

    if (!$vehicle) {
      return response()->json([
        'status' => 'error',
        'message' => 'vehicle not found'
      ], 400);
    }

    $ownerId = $request->input('owner_id');
    if ($ownerId) {
      $owner = Owner::find($ownerId);
      if (!$owner) {
        return response()->json([
          'status' => 'error',
          'message' => 'owner not found'
        ], 400);
      }
    }

    $vehicle->fill($data);
    $vehicle->save();

    return response()->json([
      'status' => 'success',
      'data' => $vehicle
    ]);
  }


  public function destroy($id)
  {
    $vehicle = Vehicle::find($id);

    if (!$vehicle) {
      return response()->json([
        'status' => 'error',
        'message' => 'vehicle not found'
      ]);
    }

    $vehicle->delete();

    return response()->json([
      'status' => 'success',
      'message' => 'vehicle deleted'
    ]);
  }
}
