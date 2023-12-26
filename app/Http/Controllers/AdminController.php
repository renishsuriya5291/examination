<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Student;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function loginFunc(Request $request)
    {
        // Check if any of the required fields is missing
        if ($request->input("email") == null || $request->input("password") == null) {
            return response()->json(['success' => false, 'message' => 'All Fields Are required'], 401);
        }

        $existingUser = Admin::where('email', $request->input('email'))->first();

        if ($existingUser) {
            if ($request->input("password") == $existingUser->password) {
                // Authentication passed

                $originalString = $request->input('email');
                $encryptedString = Crypt::encrypt($originalString);

                $response = [
                    'email' => $existingUser->email,
                    'token' => $encryptedString,
                    'userId' => $existingUser->id,
                    'role' => 'admin'
                ];

                return response()->json(['success' => true, 'message' => 'Login successful', 'User' => $response]);
            } else {
                return response()->json(['success' => false, 'message' => 'Invalid credentials'], 401);
            }
        } else {
            // Authentication failed
            return response()->json(['success' => false, 'message' => 'Invalid credentials'], 401);
        }
    }

    public function userList(Request $request)
    {
        if($request->header('token') == null){
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $token = $request->header('token');
        try{
            $decryptedString = Crypt::decrypt($token);

            $user = Admin::where('email', $decryptedString)->first();
    
            if (!$user) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
            // Fetch all records from the Student model
            $users = Student::all();
    
            // Return the records as JSON response
            return response()->json(['success' => true, 'data' => $users]);
        }catch(Exception $e){
            return response()->json(['success' => false, 'message' => 'Something went wrong...']);
        }
      
    }

    public function updateCredit(Request $request)
    {
        if($request->header('token') == null){
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $token = $request->header('token');
        try{
            $decryptedString = Crypt::decrypt($token);

            $user = Admin::where('email', $decryptedString)->first();
    
            if (!$user) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
            // Check if any of the required fields is missing
            if ($request->input("userid") == null || $request->input("credit") == null) {
                return response()->json(['success' => false, 'message' => 'All Fields Are required'], 401);
            }

            // Retrieve the user by userid
            $user = Student::where('id', intval($request->input('userid')))->first();

            // Check if the user exists
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not found'], 404);
            }

            // Update the credit column by adding the inputted credit
            $currentCredit = $user->credits;
            $newCredit = intval($request->input('credit'));
            $user->credits = $currentCredit + intval($newCredit);
            $user->save();

            return response()->json(['success' => true, 'message' => 'Credit updated successfully']);
        }catch(Exception $e){
            return response()->json(['success' => false, 'message' => 'Something went wrong...']);
        }
    }

}
