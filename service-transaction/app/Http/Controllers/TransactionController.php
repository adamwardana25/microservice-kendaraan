<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
  public function index(Request $request)
  {
    $userId = $request->input('user_id');
    $transactions = Transaction::query();

    $transactions->when($userId, function ($query) use ($userId) {
      return $query->where('user_id', '=', $userId);
    });

    return response()->json([
      'status' => 'success',
      'data' => $transactions->get()
    ]);
  }



  public function create(Request $request)
  {
    $user = $request->input('user');
    $vehicle = $request->input('vehicle');

    $transaction = Transaction::create([
      'user_id' => $user['id'],
      'vehicle_id' => $vehicle['id']
    ]);

    $transaction->metadata = [
      'vehicle_id' => $vehicle['id'],
      'vehicle_price' => $vehicle['price'],
      'vehicle_name' => $vehicle['name'],
      'vehicle_thumbnail' => $vehicle['thumbnail']
    ];

    $transaction->save();

    return response()->json([
      'status' => 'success',
      'data' => $transaction
    ]);
  }

  public function update(Request $request, $id)
  {
    $rules = [
      'status' => 'string',
      'user_id' => 'integer',
      'vehicle_id' => 'integer',
    ];


    $data = $request->all();

    $validator = Validator::make($data, $rules);

    if ($validator->fails()) {
      return response()->json([
        'status' => 'error',
        'message' => $validator->errors()
      ], 400);
    }

    $transaction = Transaction::find($id);

    if (!$transaction) {
      return response()->json([
        'status' => 'error',
        'message' => 'transaction not found'
      ], 400);
    }

    $userId = $request->input('user_id');
    if ($userId) {
      $order = Transaction::find($userId);
      if (!$order) {
        return response()->json([
          'status' => 'error',
          'message' => 'owner not found'
        ], 400);
      }
    }

    $transaction->fill($data);

    $transaction->save();

    return response()->json([
      'status' => 'success',
      'data' => $transaction
    ]);
  }
}
