<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\users;

class UserController extends Controller
{
    //initalising validation rules to be used in this list class
    //I have bundled their respective error messages when not met
    public $rules = [
        'title' => 'required|string|max:150',
    ];
    private $signUpRules = [
        'username' => 'required|string',
        'email' => 'required|unique:users,email',
        'password' => 'required|min:8'
    ];
    private $customMessages = [
        'required' => 'Cannot be empty',
        'string' => 'Please use alphabet letters',
        'min' => 'Password must have a minimum 8 characters',
    ];

    public function registerUser(Request $userData)
    {

        $validatedInput = Validator::make($userData->all(), $this->signUpRules, $this->customMessages);

        if ($validatedInput->fails()) {
            $errors = $validatedInput->errors()->toArray();
            return response()->json([
                'status' => 400,
                'success' => false,
                'data' => [
                    'message' => $errors
                ]
            ], 400);
        } else {
            $newUser = users::create([
                'username' => $userData->username,
                'email' => $userData->email,
                'password' => Hash::make($userData->password),
            ]);

            if ($newUser) {
                return response()->json([
                    'status' => 200,
                    'success' => true,
                    'data' => [
                        'user' => [
                            'username' => $userData->username,
                            'email' => $userData->email,
                        ]
                    ]
                ], 200);
            } else {
                return response()->json([
                    'status' => 400,
                    'success' => false,
                    'data' => [
                        'message' => 'User could not be created'
                    ]
                ], 400);
            }
        }
    }
    public function signInUser(Request $userData)
    {

        $user = users::where('email', '=', $userData->email)->first();
        if ($user) {
            $passValidated = Hash::check($userData->password, $user->password);
            if ($passValidated) {
                return response()->json([
                    'status' => 200,
                    'success' => true,
                    'data' => [
                        'user' => [
                            'username' => $user->username,
                            'email' => $userData->email,
                        ]
                    ]
                ], 200);
            } else {
                return response()->json([
                    'status' => 400,
                    'success' => false,
                    'data' => [
                        'message' => "Wrong password!"
                    ]
                ], 400);
            }
        } else {
            return response()->json([
                'status' => 400,
                'success' => false,
                'data' => [
                    'message' => "User not found! Please confirm your email."
                ]
            ], 400);
        }
    }
}
