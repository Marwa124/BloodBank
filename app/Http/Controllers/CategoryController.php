<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories  = Category::latest()->paginate(5);
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
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
        'name' => 'required',
      ];
      $messages = [
        'name.required' => 'يرجي ادخال الاسم',
      ];
      $this->validate($request, $rules, $messages);
      Category::create($request->all());

      toast('تم الانشاء بنجاح', 'success');
      return redirect(route('category.index'));
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      // if condition
        $category = Category::findOrFail($id);
        $posts = $category->posts()->pluck('posts.id')->toArray();
        if($posts == null)
        {
        $category->delete();
        return response()->json([
          'status' => 1,
          'message' => 'تم الحذف بنجاح',
          'id' => $id
        ]);
          /* $category->delete();
          toast('تم الحذف' , 'success'); */
        }else {
            return response()->json([
              'status' => 0,
              'message' => 'تعزر الحصول علي بيانات'
            ]);
          //toast('لا يمكنك الحذف', 'warning');
        }
        return back();
    }
}
