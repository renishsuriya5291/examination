<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class StudentController extends Controller
{
    public function RegisterFunc(Request $request)
    {
        // Check if any of the required fields is missing
        if ($request->input("name") == null || $request->input("email") == null || $request->input("password") == null || $request->input("credits") == null) {
            return response()->json(['success' => false, 'message' => 'All Fields Are required'], 401);
        }

        // Check if the email already exists in the database
        $existingUser = Student::where('email', $request->input('email'))->first();

        if ($existingUser) {
            return response()->json(['success' => false, 'message' => 'User already exists'], 401);
        }

        // If the email doesn't exist, proceed with user registration
        $newUser = new Student();
        $newUser->name = $request->input('name');
        $newUser->email = $request->input('email');
        $newUser->password = $request->input('password');
        $newUser->credits = intval($request->input('credits'));

        // Additional fields and validation can be added as needed

        $newUser->save();

        return response()->json(["success" => true, "message" => "Registered Successfully!"]);
    }

    public function loginFunc(Request $request)
    {
        // Check if any of the required fields is missing
        if ($request->input("email") == null || $request->input("password") == null) {
            return response()->json(['success' => false, 'message' => 'All Fields Are required'], 401);
        }

        $existingUser = Student::where('email', $request->input('email'))->first();

        if ($existingUser) {
            if ($request->input("password") == $existingUser->password) {
                // Authentication passed
                $originalString = $request->input('email');
                $encryptedString = Crypt::encrypt($originalString);

                $response = [
                    'email' => $existingUser->email,
                    'name' => $existingUser->name,
                    'credits' => $existingUser->credits,
                    'token' => $encryptedString
                ];

                return response()->json(['success' => true, 'message' => 'Login successful', 'User' => $response]);
            }else{
                return response()->json(['success' => false, 'message' => 'Invalid credentials'], 401);
            }
        } else {
            // Authentication failed
            return response()->json(['success' => false, 'message' => 'Invalid credentials'], 401);
        }
    }

    public function showResult(Request $request){
        if($request->header('token') == null){
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $token = $request->header('token');
        try{
            $decryptedString = Crypt::decrypt($token);

            $user = Student::where('email', $decryptedString)->first();
    
            if (!$user) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
            
            if($user->credits > 0){
                return response()->json(['success' => true, 'message' => 'You can see your result']);
            }else{
                return response()->json(['success' => true, 'message' => "You don't have Enough Credits to view the result"]);
            }
            
        }catch(Exception $e){
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

}