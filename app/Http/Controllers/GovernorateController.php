<?php

namespace App\Http\Controllers;

use App\Models\Governorate;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class GovernorateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $governorates = Governorate::paginate(10);
        return view('governorates.index', compact('governorates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('governorates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $roles = [
        'name' => 'required|max:50'
      ];
      $messages = [
        'name.required' => 'You have to enter a name'
      ];
      $this->validate($request, $roles, $messages);

      toast('Created Successfully','success');

      Governorate::create($request->all());
      return redirect(route('governorate.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $governorate = Governorate::findOrFail($id);
      return view(('governorates.edit'))->with('governorate', $governorate);
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
        $governorate = Governorate::findOrFail($id);
        $governorate->update($request->all());
        toast('Updated Successfully','success');
        return redirect(route('governorate.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $governorate = Governorate::findOrFail($id);
        $governorate->delete();
        toast('Deleted Successfully','success');
        return redirect(route('governorate.index'));
    }
}
