<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Role::create(['name' => 'عرض المستخدمين']);
        $roles = Role::latest()->paginate(5);
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //unique جدول الرتب حقل الاسم
      $rules = [
        'name' => 'required|unique:roles,name',
        'display_name' => 'required',
        'permissions_list' => 'required|array'
      ];
      $messages = [
        'name.required' => 'يجب ادخال اسم الرتبه',
        'display_name.required' => 'ادخل الاسم الوظيفي',
        'permissions_list.required' => 'ادخل صلاحيات الرتبه'
      ];
      $this->validate($request, $rules, $messages);
      $role = Role::create([
        'name' => $request->name,
        'display_name' => $request->display_name,
        'description' => $request->description
        ]);
        $role->givePermissionTo($request->permissions_list);
        //dd($request->all());
        toast('تم الانشاء بنجاح', 'success');
        return redirect(route('role.index'));
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
        $role = Role::findOrFail($id);
        return view('roles.edit', compact('role'));
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
      $rules = [
        'name' => 'required',
        'display_name' => 'required',
        'permissions_list' => 'required|array'
      ];
      $messages = [
        'name.required' => 'يجب ادخال اسم الرتبه'
      ];
      $this->validate($request, $rules, $messages);
      $role = Role::findOrFail($id);
      $role->update([
        'name' => $request->name,
        'display_name' => $request->display_name,
        'description' => $request->description
      ]);
      $role->syncPermissions($request->permissions_list);

      //dd($request->all());
        toast('تم التحديث بنجاح', 'success');
        return redirect(route('role.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $users = $role->users()->pluck('name')->toArray();
        if($users == []){
          $role->delete();
          toast('تم الحذف بنجاح', 'success');
        }else {
          toast('لا يمكنك الحذف', 'warning');
        }
        return back();
    }
}
