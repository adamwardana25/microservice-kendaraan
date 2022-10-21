<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OwnerController extends Controller
{
  public function index()
  {
    $owners = Owner::all();
    return response()->json([
      'status' => 'success',
      'data' => $owners
    ]);
  }

  public function show($id)
  {
    $owner = Owner::find($id);
    if (!$owner) {
      return response()->json([
        'status' => 'error',
        'message' => 'owner not found'
      ], 404);
    }

    return response()->json([
      'status' => 'success',
      'data' => $owner
    ]);
  }

  public function create(Request $request)
  {
    $rules = [
      'name' => 'required|string',
      'profile' => 'required|string',
      'email' => 'required|string',
      'nomor_telepon' => 'required|string'
    ];

    $data = $request->all();

    $validator = Validator::make($data, $rules);

    if ($validator->fails()) {
      return response()->json([
        'status' => 'error',
        'message' => $validator->errors()
      ], 400);
    }

    $owner = Owner::create($data);

    return response()->json(['status' => 'success', 'data' => $owner]);
  }


  public function update(Request $request, $id)
  {
    $rules = [
      'name' => 'string',
      'profile' => 'string',
      'email' => 'string',
      'nomor_telepon' => 'string'
    ];

    $data = $request->all();

    $validator = Validator::make($data, $rules);

    if ($validator->fails()) {
      return response()->json([
        'status' => 'error',
        'message' => $validator->errors()
      ], 400);
    }

    $owner = Owner::find($id);

    if (!$owner) {
      return response()->json([
        'status' => 'error',
        'message' => 'owner not found'
      ], 400);
    }

    $owner->fill($data);

    $owner->save();

    return response()->json([
      'status' => 'success',
      'data' => $owner
    ]);
  }

  public function destroy($id)
  {
    $owner = Owner::find($id);

    if (!$owner) {
      return response()->json([
        'status' => 'error',
        'message' => 'owner not found'
      ], 404);
    }

    $owner->delete();
    return response()->json([
      'status' => 'success',
      'message' => 'owner deleted'
    ]);
  }
}
