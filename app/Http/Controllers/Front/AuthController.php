<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function clientRegister()
    {
      return view('front.register');
    }

    public function clientLogin()
    {
      return view('front.login');
    }

    public function clientLoginSave(Request $request)
    {
      $validation = validator()->make($request->all(), [
        'phone' => 'required',
        'password' => 'required'
      ]);

      if($validation->fails())
      {
        toast($validation->errors()->first(), 'error');
        return back();
      }else {
        $client = Client::where('phone', $request->phone)->first();
        if ($client)
        {
          if(auth()->guard('client')->attempt($request->only('phone', 'password'))){

            toast('تم الدخول'.auth()->guard('client')->user()->name, 'success');
            return redirect(route('master'));
          }else {
            toast('كلمه المرور غير صحيحه', 'error');
          }
        }else {
          toast('بيانات الدخول غير صحيحه', 'error');
        }
      }
    }

    public function clientRegisterSave(Request $request)
    {
      $validation = validator()->make($request->all(), [
        'name' => 'required',
        'email' => 'required|email|unique:clients',
        'city_id' => 'required',
        'phone' => 'required',
        'last_donation_date' => 'required',
        'date_of_birth' => 'required',
        'blood_type_id' => 'required|exists:blood_types,id',
        'password' => 'required|confirmed',
      ]);

      if($validation->fails())
      {
        toast($validation->errors()->first(), 'error');
        return back();
      }else {
        $request->merge(['password'=> bcrypt($request->password)]);
        //$request->api_token = Str::random(60);
        $client = Client::create($request->all());
        $client->api_token = Str::random(60);
        $client->save();

        toast('you are logged in.', 'success');
        return redirect(route('master'));
      }
    }

}
