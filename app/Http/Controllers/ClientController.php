<?php

namespace App\Http\Controllers;

use App\Models\BloodType;
use App\Models\City;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if ($request['search']) {
        $clients = Client::latest()->search($request['search'])->paginate(2);
      } else {
        $clients = Client::latest()->paginate(5);
      }
      $paginate = pagePagination($clients);
      return view('clients.index', compact('clients', 'paginate'));
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
      $client = Client::find($id);
      /**
       * toggle update ??!!
       */
      if($client->is_active == 1){
        $client->is_active = 0;
        $client->update($request->all());
        toast(' تم ألغاء تفعيل ' . $client->name, 'success');
      }
      else{
        $client->is_active = 1;
        $client->update($request->all());
        toast(' تم تفعيل ' . $client->name, 'success');

      }
      return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::find($id);
        return view('clients.show', compact('client'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        toast('Deleted Successfully','success');
        return back();
    }
}
