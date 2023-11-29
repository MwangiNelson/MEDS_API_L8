<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\orders;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function apiDeliver($statusCode, $message)
    {
        return response()->json([
            'status' => $statusCode,
            'data' => $message
        ], $statusCode);
    }
    //
    public function addOrder(Request $data){
        $new_item = orders::create([
            'order_details' => json_encode($data->order_details),
            'user_token' => $data->user_token
        ]);

        //if it's inserted, return an OK response else ERROR response
        if ($new_item) {
            return $this->apiDeliver(200, "Record inserted successfully");
        } else {
            return $this->apiDeliver(400, "Record could not be inserted");
        }
    }
}
