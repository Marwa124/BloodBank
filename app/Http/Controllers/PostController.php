<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts  = Post::latest()->paginate(10);

        $paginate = pagePagination($posts);
        /* $current_page = $posts->currentPage($posts)-1;
        $per_page = $posts->perPage($posts);
        $total = $current_page * $per_page; */
        return view('posts.index', compact('posts', 'paginate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
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
        'title' => 'required',
        'categories_list' => 'required|array',
        'content' => 'required',
        'image' => 'required|image|max:2000'
      ];
      $messages = [
        'categories_list.required' => 'يرجي ادخال التصنيف',
        'title.required' => 'يرجي ادخال العنوان',
        'content.required' => 'محتوي المقال مطلوب',
        'image.required' => 'حقل الصوره مطلوب'
      ];
      $this->validate($request, $rules, $messages);
      $post =Post::create($request->all());


      if ($request->hasFile('image')) {
        $path = public_path();
        $destinationPath = $path . '/uploads/posts/'; // upload path

        $photo = $request->file('image');
        $extension = $photo->getClientOriginalExtension(); // getting image extension
        $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
        $photo->move($destinationPath, $name); // uploading file to given path


      $photo = Image::make($destinationPath . $name);
      $photo->resize(400, 300)->save($destinationPath . $name, 100);


        $post->image = 'uploads/posts/' . $name;
      }

      $post->categories()->attach($request->categories_list);
      $post->save();
      toast('تم الانشاء بنجاح', 'success');
      return redirect(route('post.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $categories = $post->categories()->pluck('name')->toArray();
        return view('posts.show', compact('post', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $post = Post::findOrFail($id);
      return view('posts.edit', compact('post'));
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
      $post = Post::findOrFail($id);
      $post->update($request->all());

      if ($request->hasFile('image')) {
        $img = $request->file('image');

        $post->image = 'uploads/posts/' . $this->imageStore($img);
      }

      $post->categories()->sync($request->categories_list);
      $post->update();

      toast('تم التعديل بنجاح', 'success');
      return redirect(route('post.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $categories = $post->categories()->pluck('categories.id')->toArray();
        $post->categories()->detach($categories);
        $post->delete();
        toast('Deleted Successfully','success');

        return back();
    }

    public function deleteAll(Request $request)
    {
      $ids = $request->ids;
      //dd($ids);
      $post = Post::whereIn('id', explode(',', $ids))->get();
      if($post){
        for ($i=0; $i < count($post); $i++) {

          $categories = $post[$i]->categories()->pluck('categories.id')->toArray();
          $post[$i]->categories()->detach($categories);
          $post[$i]->delete();
        }

      }
      return response()->json([
        'status' => 1,
        'success' => 'تم الحذف بنجاح',
      ]);
      // toast('Deleted Successfully','success');
      // return back();
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
