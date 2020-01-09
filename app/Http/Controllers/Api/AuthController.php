<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\Models\Client;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:clients',
            'city_id' => 'required',
            'phone' => 'required',
            'last_donation_date' => 'required',
            'date_of_birth' => 'required',
            'blood_type_id' => 'required'
        ]);

        if($validation->fails())
        {
            return apiResponse(0, $validation->errors()->first(), $validation->errors());
        }

        $request->merge(['password' => bcrypt($request->password)]);
        $client = Client::create($request->all());
        $client->api_token = Str::random(60);
        $client->save();

        return apiResponse(1, 'تم الاضافه بنجاح', [
            'api_token' => $client->api_token,
            'client' => $client
        ]);
    }

    public function login(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'phone' => 'required',
            'password' => 'required'
        ]);

        if($validation->fails())
        {
            return apiResponse(0, $validation->errors()->first(), $validation->errors());
        }

        $client = Client::where('phone', $request->phone)->first();
        if ($client)
        {
            if(Hash::check($request->password, $client->password)){
                return apiResponse(1, 'تم الدخول', [
                    'api_token' => $client->api_token,
                    'client' => $client
                ]);
            }else {
                return apiResponse(0, 'كلمه المرور غير صحيحه');
            }
        }else {
            return apiResponse(0, 'بيانات الدخول غير صحيحه');
        }
    }

    public function resetPassword(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'phone' => 'required'
        ]);

        if($validation->fails())
        {
            return apiResponse(0, $validation->errors()->first());
        }

        $client = Client::where('phone', $request->phone)->first();
        if($client)
        {
            $pin_code = rand(1111, 9999);
            Mail::to($client->email)
                ->cc('marwatest124@gmail.com')
                ->send(new ResetPassword($pin_code));

            return apiResponse(1, 'success', [
                'pin_code' => env('APP_DEBUG') ? $pin_code :'check your mail',
                'api_token' => $client->api_token,
                'client'  => $client
            ]);
        }else{
            return apiResponse(0, 'لا وجد ايميل مسجل بهذالرقم');
        }
    }

    public function registerToken(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'platform' => 'required|in:android,ios',
            'token' => 'required',
        ]);

        if($validation->fails())
        {
            $data = $validation->errors();
            return apiResponse(0, $data->first(), $data);
        }

        Token::where('token', $request->token)->delete();

        $request->user()->tokens()->create($request->all());
        return apiResponse(1, 'تم التسجيل بنجاح');
    }

    public function removeToken(Request $request)
    {
        $validation = validator()->make($request->all(),[
            'token' => 'required'
        ]);

        if($validation->fails())
        {
            $data = $validation->errors();
            return apiResponse(0, $data->first(), $data);
        }

        Token::where('token', $request->token)->delete();
        return apiResponse(1, 'تم الحذف بنجاح');
    }
}
