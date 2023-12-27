<?php

namespace App\Http\Controllers;

use App\Models\Teachers;
use Exception;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;


class StudentController extends Controller
{
    public function RegisterFunc(Request $request)
    {
        // Check if any of the required fields is missing
        if ($request->input("name") == null || $request->input("email") == null || $request->input("password") == null) {
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
        if ($request->input('credits') != null) {
            $newUser->credits = intval($request->input('credits'));
        } else {
            $newUser->credits = 0;
        }

        // Additional fields and validation can be added as needed

        $newUser->save();

        return response()->json(["success" => true, "message" => "Registered Successfully!", "User" => $newUser]);
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
                    'userId' => $existingUser->id,
                    'email' => $existingUser->email,
                    'name' => $existingUser->name,
                    'credits' => $existingUser->credits,
                    'token' => $encryptedString,
                    'role' => 'student'
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

    public function updateCredit(Request $request)
    {

        if ($request->header('token') == null) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $token = $request->header('token');
        try {
            $decryptedString = Crypt::decrypt($token);

            $user = Student::where('email', $decryptedString)->first();

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
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Something went wrong...']);
        }
    }

    public function showResult(Request $request)
    {
        if ($request->header('token') == null) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $token = $request->header('token');
        try {
            $decryptedString = Crypt::decrypt($token);

            $user = Student::where('email', $decryptedString)->first();

            if (!$user) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            if ($user->credits > 0) {
                return response()->json(['success' => true, 'message' => 'You can see your result']);
            } else {
                return response()->json(['success' => true, 'message' => "You don't have Enough Credits to view the result"]);
            }

        } catch (Exception $e) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    public function fetchCredits(Request $request)
    {
        if ($request->header('token') == null) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $token = $request->header('token');
        try {
            $decryptedString = Crypt::decrypt($token);

            $user = Student::where('email', $decryptedString)->first();

            if (!$user) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            return response()->json(['success' => true, 'credit' => $user->credits]);

        } catch (Exception $e) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    public function fetchTeachers(Request $request)
    {
        if ($request->header('token') == null) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $token = $request->header('token');
        try {
            $decryptedString = Crypt::decrypt($token);

            $user = Student::where('email', $decryptedString)->first();

            if (!$user) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            if ($request->route("id") == null) {

                $Teacher = Teachers::all();

                return response()->json(['success' => true, 'data' => $Teacher]);
            } else {
                $teacher = Teachers::find($request->route("id"));

                if ($teacher) {
                    // Do something with the $teacher
                    return response()->json(['success' => true, 'data' => $teacher]);
                } else {
                    // Handle the case where no teacher is found
                    return response()->json(['success' => false, 'data' => 'Teacher not found'], 404);
                }
            }
        } catch (Exception $e) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    public function showTeacher($id)
    {
        return view('teachers.show', ['id' => $id]);
    }

    public function decreaseCredit(Request $request)
    {
        if ($request->header('token') == null) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }
        $token = $request->header('token');
        try {
            $decryptedString = Crypt::decrypt($token);

            $user = Student::where('email', $decryptedString)->first();

            if (!$user) {
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
            }

            $APP_CREDIT_VALUE = env('APP_CREDIT_VALUE');

            // $number_of_credit_decrease = ;
            $student = Student::where('email', $decryptedString)->first();

            if ($student) {
                if ($student->credits <= 0) {
                    return response()->json(['success' => false, 'message' => 'Insufficient Credit'], 404);
                } else {
                    $final_value = $student->credits - $APP_CREDIT_VALUE;

                    // Instead of using update, set the attribute and then save
                    $student->credits = $final_value;
                    $student->save();

                    return response()->json(['success' => true, 'message' => 'Credit updated successfully', 'credit'=>$final_value]);
                }

            } else {
                return response()->json(['success' => false, 'message' => 'not found'], 404);
            }




        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }
    }

}
