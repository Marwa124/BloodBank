<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
  function __construct()
  {
      $this->middleware('auth');
  }

  public function changePassword()
  {
    return view('users.reset-password');
  }

  public function changePasswordSave(Request $request)
  {
    $rules = [
      'old-password' => 'required',
      'new-password' => 'required'
    ];
    $messages = [
      'old-password.required' => 'كلمه السر الحاليه مطلوبه',
      'new-password.required' => 'كلمه السر مطلوبه'
    ];
    $this->validate($request, $rules, $messages);

    $user = Auth::user();

    if(Hash::check($request->input('old-password'), $user->password))
    {
      //the password match..
      $user->password = bcrypt($request->input('new-password'));
      $user->save();
      toast('تم التحديث بنجاح', 'success');
      return view('home');

    }else {
      toast('كلمه المرور غير صحيحه', 'error');
      return view('users.reset-password');
    }
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(5);
        //$users = User::first()->getRoleNames();
        //dd($users);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* $user = User::first();
        $role = Role::all();
        $roles = $user->getRoleNames();

        dd($roles); */
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $rules = [
        'name' => 'required|unique:users,name',
        'password' => 'required|confirmed',
        'phone' => 'required',
        'email' => 'required|email|unique:users,email',
        'roles_list' => 'required|array'
      ];
      $messages = [

      ];
        $this->validate($request, $rules, $messages);
        $request->merge(['password' => bcrypt($request->password)]);
        $user = User::create($request->all());
        $user->assignRole($request->roles_list);
        $user->save();
        return redirect(route('user.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with('email')->findOrFail($id);
        $roles = $user->getRoleNames(); // get the names of the user's roles
        return view('users.show', compact('user', 'orders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $user = User::findOrFail($id);
      return view('users.edit', compact('user'));
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
        $user = User::findOrFail($id);

        $user->syncRoles($request->roles_list);
        $user->update($request->all());

       // dd($user->password);
        toast('تم التعديل', 'success');
        return redirect(route('user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        toast('تم الحذف بنجاح', 'success');
        return redirect()->back();

        // if(!$user)
        // {
        //   return response()->json([
        //     'status' => 0,
        //     'message' => 'تعزر الحصول علي بيانات'
        //   ]);
        // }

        // return response()->json([
        //   'status' => 1,
        //   'message' => 'تم الحذف بنجاح',
        //   'id' => $id
        // ]);
    }
}
