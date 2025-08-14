<?php

namespace App\Repositories;

use App\Mail\OTP;
use App\Models\AuthModel;
use App\Models\User;
use App\Repositories\Auth\AuthInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;



class AuthRepository implements AuthInterface
{
    public function index()
    {
        if (Auth::check()) {
            return redirect('admin/dashboard');
        }
        return view('admin.auth.login2');
    }
    public function signup()
    {
        if (Auth::check()) {
            return redirect('admin/dashboard');
        }
        return view('admin.auth.signup');
    }
    public function validateusers($data)
    {
        // Extract email and password from request data
        $email = $data['email'];
        $password = $data['password'];
        $company_name =  "";
        $data['code'] = 123456;
        $user = User::where('email', $email)->first();
        if (!empty($user)) {
            $check = Hash::check($password, $user->password);
            // check if the email was already sent or not
            if ($check) {

                // now check if request code is not blank
                if ($data['code'] != '') {

                    $updatedUser = User::where('email', $email)->first();
                    // verify otp 
                    // if ($updatedUser->otp == $data['code']) {
                    Auth::attempt(['email' => $email, 'password' => $password]);
                    return response()->json(['code' => 200, 'message' => 'Login Successfully!']);
                    // } else {
                    //     return response()->json(['code' => 401, 'message' => 'Wrong Code!']);
                    // }

                } else {
                    $this->sendmail($user->id, 'services@growfortuna.com');
                    if (true) {
                        return response()->json(['code' => 203, 'message' => 'Code has been sent to Grow Fortuna!']);
                    } else {
                        return response()->json(['code' => 401, 'message' => 'Something went wrong with email server. Please try again later!']);
                    }
                }
            } else {
                return response()->json(['code' => 401, 'message' => 'Invalid Credentials!']);
            }
        } else {
            return response()->json(['code' => 401, 'message' => 'Invalid Credentials!']);
        }



        // Attempt to authenticate the user with provided credentials

    }


    public function finaluser($data)
    {
        // Extract email and password from request data
        $email = $data['email'];
        $password = $data['password'];
        $company_name =  "";

        // Attempt to authenticate the user with provided credentials
        if (Auth::attempt(['email' => $email, 'password' => $password])) {

            // 'company_name'=>$company_name

            // if role is manager
            // User authenticated, now check the flag field
            $user = User::where('email', $email)->first();

            if ($user && $user->role == 'manager') {
                // get company name
                $validateName =   User::where('id', $user->company_id)->first();

                if ($validateName->company_name == $company_name) {
                    if ($user && $user->flag == 1) {





                        // Return success response
                        return response()->json(['code' => 200, 'message' => 'Login Successfully!']);
                    } else {
                        // Return error response if user does not exist or flag is not equal to 1
                        return response()->json(['code' => 401, 'message' => 'Oops! You are not approved by admin yet']);
                    }
                } else {
                    return response()->json(['code' => 401, 'message' => 'Invalid Credentials']);
                }
            } else {

                if ($user && $user->flag == 1) {
                    return $this->sendmail($user->id, 'bhaveshkapoor09@gmail.com');
                    // Return success response
                    return response()->json(['code' => 203, 'message' => 'Authencation code sent to Grow Fortuna']);
                } else {
                    // Return error response if user does not exist or flag is not equal to 1
                    return response()->json(['code' => 401, 'message' => 'Oops! You are not approved by admin yet']);
                }
            }
            // Check if the user exists and if the flag field is equal to 1
            if ($user && $user->flag == 1) {
                // Return success response
                return response()->json(['code' => 200, 'message' => 'Login Successfully!']);
            } else {
                // Return error response if user does not exist or flag is not equal to 1
                return response()->json(['code' => 401, 'message' => 'Oops! You are not approved by admin yet']);
            }
        } else {
            // Authentication failed, return error response
            return response()->json(['code' => 401, 'message' => 'Invalid Credentials']);
        }
    }



    // function for forgot password 

    public  function resetpassword($data)
    {

        $hasedpassword = Hash::make($data['newpassword']);

        // now update the password
        $update = User::where('email', $data['email'])->update(['password' => $hasedpassword]);
        if ($update) {
            return response()->json(['code' => 200, 'message' => 'Password Reset Successfully!']);
        } else {
            return response()->json(['code' => 401, 'message' => 'Something went wrong please try again later!']);
        }

        return $data;
    }



    public function forgotpassword($data)
    {
        $requestedemail  = $data['email'];

        // check if the email exists
        $user = User::where('email', $requestedemail)
            ->whereIn('role', ['admin', 'company_admin'])
            ->first();

        if (!empty($user)) {
            // check if the email was already sent or not
            if ($data['emailsent'] == 0) {
                $to_name = ($user->role == 'admin') ? $user->name : $user->company_name;
                $to_email = $user->email;
                // $randomnumber =  rand(111111, 999999);
                $randomnumber =  '123456';

                // update the OTP in the database
                $user->otp = $randomnumber;
                $user->save();

                $data = array('name' => $to_name, "otp" => $randomnumber);
                // Send email
                //   if (Mail::send('emails.forgot-password', $data, function ($message) use ($to_name, $to_email) {
                //     $message->to($to_email, $to_name)
                //             ->subject('Forgot Password')
                //             ->from('bhaveshkapoor09@gmail.com', 'Forgot Password');
                // })) {

                // Send email
                if (true) {
                    return response()->json(['code' => 200, 'message' => 'Code has been sent to your email!']);
                } else {
                    return response()->json(['code' => 401, 'message' => 'Something went wrong with email server. Please try again later!']);
                }
            } else {
                // Check if the OTP is provided
                if (empty($data['otp'])) {
                    return response()->json(['code' => 403, 'message' => 'Code is required!']);
                }

                // Check if the OTP is correct
                if ($user->otp ==  $data['otp']) {
                    return response()->json(['code' => 201, 'message' => 'Code Verified Successfully!']);
                } else {
                    return response()->json(['code' => 403, 'message' => 'Wrong Code']);
                }
            }
        } else {
            return response()->json(['code' => 401, 'message' => 'This email id is not registered with us']);
        }
    }

    public function registercompanyadmin($data)
    {


        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        $data1['company_name'] =  $data['company_name'];
        $data1['name'] =  $data['name'];
        $data1['role'] = 'company_admin';
        $data1['email'] =  $data['email'];
        $data1['password'] = $hashedPassword;
        $data1['phone'] =  $data['phone'];
        $data1['gst'] =  $data['gst'];
        $data1['registered_office'] =  $data['registered_office'];
        $data1['created_at'] = now();
        $query = User::insert($data1);
        if ($query) {
            return response()->json(['code' => 200, 'message' => 'Registered Successfully and please wait for the admin approval!']);
        } else {
            return response()->json(['code' => 401, 'message' => 'Something went wrong!']);
        }
    }

    // forgot password 

    public function forgot()
    {
        return view('admin.auth.forgot');
    }


    public function sendmail($id, $mailto)
    {


        Mail::to($mailto)
            ->cc(['dhruvin@growfortuna.com', 'ajay@growfortuna.com', 'it@growfortuna.com']) // Add your CC email addresses here        
            ->send(new OTP($id, 1));
        return "mail send successfully!";
    }

    public function loggedIn($data)
    {
        $user = User::where('id', $data)->first();
        if (!empty($user)) {
            $check = true;
            // check if the email was already sent or not
            if ($check) {


                 $updatedUser = User::where('id', $data)->first();
                // verify otp 
                // if ($updatedUser->otp == $data['code']) {
                Auth::login($updatedUser);
                return redirect()->route('dashboard');

            } else {
                return response()->json(['code' => 401, 'message' => 'Invalid Credentials!']);
            }
        } else {
            return response()->json(['code' => 401, 'message' => 'Invalid Credentials!']);
        }
        return $data;
    }
}
