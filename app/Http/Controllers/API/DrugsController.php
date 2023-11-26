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

    //adds a new drug into the db
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

    //GETS ALL DRUGS
    public function getAllDrugs()
    {
        $durgs = drugs::all();

        if ($durgs->count() > 0) {
            return $this->apiDeliver(200, $durgs);
        } else {
            return $this->apiDeliver(400, "No records found");
        }
    }

    //GETS A SPECIFIC DRUG IN THE DB
    public function getSpecificDrug($id)
    {
        $selected = drugs::find($id);
        if ($selected) {

            //the selected data is reyurned as data in the API json
            return $this->apiDeliver(200, $selected);
        } else {

            //else an error message is sent back 
            return $this->apiDeliver(404, "No such record was found");
        }
    }

    //GETS DRUGS BY SORTING BY CATEGORY
    public function getCategoricalDrugs($category)
    {

        $drugs = drugs::where('drug_category', $category)->get();
        if ($drugs) {
            //the $drugs data is reyurned as data in the API json
            return $this->apiDeliver(200, $drugs);
        } else {

            //else an error message is sent back 
            return $this->apiDeliver(404, "No such record was found");
        }
    }

    //EDIT DRUG

    //ADD DRUG CATEGORY

    //GET DRUGS CATEGORIES

    //EDIT DRUG CATEGORY

    //
}
