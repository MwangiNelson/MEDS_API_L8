<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\User;
use App\Models\drugs;
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
    private function generateRandomToken()
    {
        $token = '';

        for ($i = 0; $i < 16; $i++) {
            // Generate a random character (you can customize the character set if needed)
            $randomChar = chr(rand(33, 126)); // ASCII values for printable characters

            // Add the character to the token
            $token .= $randomChar;

            // Add a hyphen after every 4 characters
            if (($i + 1) % 4 == 0 && $i < 15) {
                $token .= '-';
            }
        }

        $used_token = users::where('user_token', $token)->first();
        if ($used_token) {
            $this->generateRandomToken();
        } else {
            return $token;
        }
    }
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
    public function getAllUsers()
    {
        $users = users::all();

        return $this->sendResponse($users, 'Users fetched successfully');
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
                'user_token' => $this->generateRandomToken(),
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
                            'role' => 'user',
                            'user_token' => $newUser->user_token

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
                            'role' => $user->user_role,
                            'user_token' => $user->user_token
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
    public function deleteUser($id)
    {
        $deleted_user = users::find($id)->delete();

        if ($deleted_user) {
            return  $this->sendResponse(200, 'User deleted successfully');
        } else {
            return  $this->sendError(404, 'User deletion failed.');
        }
    }
    public function updateUser(Request $request, $id)
    {

        // Validate the incoming request data
        $validatedData = $request->validate([
            'user_name' => 'required|string|max:125',
            'user_token' => 'required|string',
            'user_email' => 'required',
            'user_role' => 'required',
        ]);

        $user = users::findOrFail($id);

        if ($user) {
            $user->update([
                'user_name' => $validatedData['user_name'],
                'user_token' => $validatedData['user_token'],
                'user_email' => $validatedData['user_email'],
                'user_role' => $validatedData['user_role']
            ]);

            return $this->sendResponse($user, 'User updated successfully');
        } else {
            return $this->sendResponse(400, 'update failed');
        }
    }

    public function getStats()
    {
        $users = users::count();
        $drugs = drugs::count();
        return $this->sendResponse([$users, $drugs], 'All statistical counts');
    }
}
