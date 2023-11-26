<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\users;
use App\Models\cookbooks;
use App\Models\recipes;

class RecipeController extends Controller
{
    //auxilliary methods section
    //This method is to simplify the json return in each for each method shortening the codebase
    public function apiDeliver($statusCode, $message)
    {
        return response()->json([
            'status' => $statusCode,
            'data' => $message
        ], $statusCode);
    }


    public function addRecipe(Request $data)
    {
        //if data is valid , then insert into db
        $new_item = recipes::create([
            'title' => $data->title,
            'author' => $data->author,
            'likes' => $data->likes,
            'description' => $data->desc,
            'image_url' => $data->url,
            'ingredients' => $data->ingredients

        ]);

        //if it's inserted, return an OK response else ERROR response
        if ($new_item) {
            return $this->apiDeliver(200, "Record inserted successfully");
        } else {
            return $this->apiDeliver(400, "Record could not be inserted");
        }
    }

    public function getAllRecipes()
    {
        //gets all recipes
        $tests = recipes::all();

        //if none return an error code message of 400
        if ($tests->count() > 0) {
            return $this->apiDeliver(200, $tests);
        } else {
            return $this->apiDeliver(400, "No records found");
        }
    }

    public function getTopRecipes()
    {
        $topRecipes = recipes::orderBy('likes', 'desc')->take(5)->get();
        //if none return an error code message of 400
        if ($topRecipes->count() > 0) {
            return $this->apiDeliver(200, $topRecipes);
        } else {
            return $this->apiDeliver(400, "No records found");
        }
    }

    //gets the specific queried Recipe using its id as an argument
    public function getSpecificRecipe($id)
    {
        $selected = recipes::find($id);
        if ($selected) {

            //the selected data is reyurned as data in the API json
            return $this->apiDeliver(200, $selected);
        } else {

            //else an error message is sent back 
            return $this->apiDeliver(404, "No such record was found");
        }
    }

    //cookbooks API syntax
    public function addToCookBook(Request $data)
    {
        $recipeId = $data->input('recipe_id');

        $user = users::where('username', "=", $data->username)->first();
        $cookbook = cookbooks::firstOrNew(['user_id' => $user->id]);

        // Deserialize the saved_recipes JSON data into an array
        $savedRecipes = $cookbook->saved_recipes ? json_decode($cookbook->saved_recipes, true) : [];

        if (!in_array($recipeId, $savedRecipes)) {
            $savedRecipes[] = $recipeId;
            $cookbook->user_id = $user->id;
            $cookbook->saved_recipes = json_encode($savedRecipes); // Serialize the array back to JSON
            $saveSuccessful = $cookbook->save();

            if ($saveSuccessful) {
                $requestedRecipe = recipes::find($recipeId);
                $requestedRecipe->update(
                    [
                        'likes' => $requestedRecipe->likes + 1
                    ]
                );
            }
        }

        // Return a success response
        return response()->json([
            'message' => 'Recipe added to cookbook',
            'data' => $cookbook
        ]);
    }
    public function getCookBook(Request $userData)
    {
        $user = users::where('email', $userData->email)->first();
        $user_id = $user->id;

        $cookbook = cookbooks::where('user_id', $user_id)->first();

        if ($cookbook == null) {
            return response()->json([
                'status' => 200,
                'message' => 'No cookbooks found for this user',
                'data' => []
            ], 200);
        }

        $recipes = recipes::whereIn('id', array_map('intval', json_decode($cookbook->saved_recipes)))->get();
        return response()->json(['data' => $recipes],  200);
    }
}
