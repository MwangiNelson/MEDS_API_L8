<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\User;
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
        'email' => 'required|unique:tbl_users,user_email',
        'password' => 'required|min:8'
    ];
    private $customMessages = [
        'required' => 'Cannot be empty',
        'string' => 'Please use alphabet letters',
        'min' => 'Password must have a minimum 8 characters',
    ];

    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];
        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }


    public function getAllUsers(){
        $users = users::all();

        return $this->sendResponse($users,'Users fetched successfully');        
    }

    public function registerUser(Request $userData)
    {

        $validatedInput = Validator::make($userData->all(), $this->signUpRules, $this->customMessages);

        if ($validatedInput->fails()) {
            $errors = $validatedInput->errors()->toArray();
            return $this->sendError('Validation Error', $errors);
        } else {
            $newUser = users::create([
                'user_name' => $userData->username,
                'user_email' => $userData->email,
                'user_password' => Hash::make($userData->password),
                'user_role' => empty($userData->user_role) ? 'user' : $userData->user_role
            ]);

            // $user_data = $userData->all();
            // $user_data['password'] = bcrypt($user_data['password']);
            // $newUser = User::create($user_data);
            // $success['token'] =  $newUser->createToken('MyAuthApp')->plainTextToken;
            // $success['name'] =  $newUser->name;

            // return $this->sendResponse($success, 'User created successfully.');

            if ($newUser) {
                return response()->json([
                    'status' => 200,
                    'success' => true,
                    'data' => [
                        'user' => [
                            'username' => $userData->username,
                            'email' => $userData->email,
                            'role'=> 'user'
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

        $user = users::where('user_email', '=', $userData->email)->first();
        if ($user) {
            $passValidated = Hash::check($userData->password, $user->user_password);
            if ($passValidated) {
                return response()->json([
                    'status' => 200,
                    'success' => true,
                    'data' => [
                        'user' => [
                            'username' => $user->user_name,
                            'email' => $user->user_email,
                            'role'=>$user->user_role
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
