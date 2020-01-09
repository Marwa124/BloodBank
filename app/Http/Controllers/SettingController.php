<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $setting = Setting::findOrFail($id);

        if ($request->hasFile('image')) {

          $img = $request->file('image');
          $setting->image = 'uploads/posts/' . $this->imageStore($img);
          $setting->update([$setting->app_logo = $request['image']]);
        }

        $setting->update($request->all());
        return response()->json([
          'status' => 1,
          'message' => 'تم التعديل بنجاح',
          'id' => $id,
          'setting' => $setting
        ]);

    }

    public function image(Request $request, $id)
    {
      $setting = Setting::findOrFail($id);

      if ($request->hasFile('image')) {

        $img = $request->file('image');
        $setting->image = 'uploads/posts/' . $this->imageStore($img);
        $setting->update([
          $setting->app_logo = $request['image'],
        ]);
      }
      $setting->update([$setting->app_logo = $request['image']]);
      dd($setting->app_logo);
    }

    public function imageStore($img)
    {
        $path = public_path();
        $destinationPath = $path . '/uploads/posts/'; // upload path

        $photo = $img;
        $extension = $photo->getClientOriginalExtension(); // getting image extension
        $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
        $photo->move($destinationPath, $name); // uploading file to given path


      $photo = Image::make($destinationPath . $name);
      $photo->resize(300, 300, function ($constraint) {
        /***
         *
         */
          $constraint->aspectRatio();
      })->save($destinationPath . $name, 100);

      return $name;
    }

}
