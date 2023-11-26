<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\drugs;
use Illuminate\Http\Request;

class DrugsController extends Controller
{
    public function apiDeliver($statusCode, $message)
    {
        return response()->json([
            'status' => $statusCode,
            'data' => $message
        ], $statusCode);
    }

    public function addDrugs(Request $data)
    {
        //if data is valid , then insert into db
        $new_item = drugs::create([
            'drug_name' => $data->drug_name,
            'drug_category' => $data->drug_category,
            'drug_image' => $data->drug_image,
            'drug_description' => $data->drug_description,
            'drug_price' => $data->drug_price,
            'unit_quantity' => $data->unit_quantity,
            'unit_description' => $data->unit_description


        ]);

        //if it's inserted, return an OK response else ERROR response
        if ($new_item) {
            return $this->apiDeliver(200, "Record inserted successfully");
        } else {
            return $this->apiDeliver(400, "Record could not be inserted");
        }
    }

    public function getAllDrugs(){
        $durgs = drugs::all();

        if($durgs->count() > 0 ){
            return $this->apiDeliver(200,$durgs);
        }else{
            return $this->apiDeliver(400, "No records found");

        }
    }
}
