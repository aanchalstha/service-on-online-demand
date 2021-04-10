<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;

use Auth;
use Image;

use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $category = Category::paginate(15);

        return view('category.show',['categories' => $category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

        $category = Category::get();

        return view('category.create',['category',$category]);

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'category_title' => 'required',
            'catimage' => 'image|required',

        ]);

        $category = new Category;


        if($request->hasFile('catimage')) {
            // dd("success");
            $file = $request->file('catimage');
            // dd($file);
            $extension = $file->getClientOriginalExtension();
            $filename = date("Y_m_d_H_m_s") . '_Category.'.$extension;
            $img = Image::make($request->file('catimage'))->resize(600, 500)->save('uploads/'.$filename, 60);
            // dd($img);
        } else {
            // dd("fail");
            $filename = "noimage.jpg";
        }
        // dd($filename);
        $category->name = $request->input('category_title');
        $category->image = $filename;
        $category->description = $request->input('description');
        $category->status = $request ->input('status');
        $category->save();
        return redirect()->route('categories')->with(['message'=> 'Category Successfully Added!!']);

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $category = Category::find($id);
        return view('category.editCategory',['category' => $category]);
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
        $this->validate($request,[
            'category_title' => 'required',
            'image' => 'image|nullable',
        ]);

        $category = Category::find($id);


        if($request->hasFile('image')) {
            // dd("success");
            $file = $request->file('image');
            // dd($file);
            $extension = $file->getClientOriginalExtension();
            $filename = date("Y_m_d_H_m_s") . '_Category.'.$extension;
            $img = Image::make($request->file('image'))->resize(600, 500)->save('uploads/'.$filename, 60);
            // dd($img);
        } else {
            // dd("fail");
            $filename = Category::where('id',$id)->pluck('image')->first();
        }

        $category->name = $request->input('category_title');
        $category->image = $filename;
        $category->description = $request->input('description');
        $category->status = $request ->input('status');
        $category->update();
        return redirect()->route('categories')->with(['message'=> 'Category Successfully Updated!!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $cat = Category::find($id);

        $cat->delete();

        return redirect()->route('categories')->with(['error'=> 'Category Successfully Deleted.']);
    }
}
