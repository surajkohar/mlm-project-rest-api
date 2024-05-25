<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Str;
use App\Models\User;

class UserController extends Controller
{
    public function register(UserRequest $request){

     
        if(User::where('email',$request->email)->first()){
            return response([
                'message'=>'Email Already Exist',
                'status'=>'failed',
            ],200);
        }

        $referredByUser = User::where('referral_codes', $request['referral_codes'])->first();
        $name = $request['name'];
        $randomDigit = rand(10, 99);
        $referralCode = strtolower(str_replace(' ', '', $name)) . $randomDigit;

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request->password),
            'referral_codes'=>$referralCode,
            'referred_by'=>$referredByUser->name,
            'referred_person_id'=>$referredByUser->id,
        ]);

         $commissionAmount=100;
         $referredByUser->commission += $commissionAmount;
         $referredByUser->save();

         $commissionPercentage = 0.05;
         $additionalCommission = $commissionAmount * $commissionPercentage;
         
         $user->commission += $additionalCommission;
         $user->save();

         $token=$user->createToken($request->email)->plainTextToken;
        return response([
            'token'=>$token,
            'message'=>'Registration Success',
            'status'=>'Success',
        ],201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required',
        ]);

        $user=User::where('email',$request->email)->first();

            if($user && Hash::check($request->password, $user->password)){
                $token=$user->createToken($request->email)->plainTextToken;
                session()->put('token',$token);
                return response([
                    'token'=>$token,
                    'message'=>'Login Success',
                    'status'=>'Success',
                ],200);
            }
            return response([
                'message'=>'The Provided Credentials are incorrect',
                'status'=>'failed',
            ],401);
        
    }

    public function logout(){

        auth()->user()->tokens()->delete();
        session()->forget();
        dd(session()->all());
        return response([
            'message'=>'Logout Success',
            'status'=>'Success',
        ],200);
    }

    public function chnagePassword(Request $request){
        $request->validate([
            'password' => 'required|confirmed',
        ]);
        $loginUser=auth()->user();
        $loginUser->password=Hash::make($request->password);
        $loginUser->save();
        return response([
            'message'=>'Password Changed Successfully',
            'status'=>'Success',
        ],200);
    }

    public function loggedUser(){
       $user=auth()->user();
       return response([
        'loggedUser'=>$user,
        'message'=>'Fetched login user successfully',
        'status'=>'Success',
         ],200);
    }
}
