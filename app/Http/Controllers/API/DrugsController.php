<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\drug_categories;
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

    public function addCategory(Request $data)
    {
        //if data is valid , then insert into db
        $new_item = drug_categories::create([
            'category_name' => $data->category_name,
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

     //GETS ALL DRUGS
     public function getAllCategories()
     {
         $durgs = drug_categories::all();
 
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
    public function editDrug(Request $request, $id){
        // Validate the incoming request data
        $validatedData = $request->validate([
            'drug_name' => 'required|string|max:255',
            'drug_category' => 'required|string|max:255',
            'drug_image' => 'nullable|url',
            'drug_price' => 'required|numeric|min:0',
            'drug_description' => 'nullable|string',
            'unit_quantity' => 'required|integer|min:0',
            'unit_description' => 'nullable|string',
        ]);

        // Find the drug by ID
        $drug = drugs::findOrFail($id);

        // Update the drug properties
        $drug->update([
            'drug_name' => $validatedData['drug_name'],
            'drug_category' => $validatedData['drug_category'],
            'drug_image' => $validatedData['drug_image'],
            'drug_price' => $validatedData['drug_price'],
            'drug_description' => $validatedData['drug_description'],
            'unit_quantity' => $validatedData['unit_quantity'],
            'unit_description' => $validatedData['unit_description'],
        ]);

        return $this->apiDeliver(200, 'Meds Updated');
    }
    //DELETE DRUG
    public function deleteDrug($id){
        $deleted_drug = drugs::find($id)->delete();

        if($deleted_drug){
            return  $this->apiDeliver(200, 'Drug deleted successfully');
        }else{
            return  $this->apiDeliver(404, 'Drug deletion failed.');
        }
    }

    //ADD DRUG CATEGORY

    //GET DRUGS CATEGORIES

    //EDIT DRUG CATEGORY

    
}
