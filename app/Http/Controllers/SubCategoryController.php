<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\SubCategories;
use Auth;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $subcat = SubCategories::paginate(15);


        return view('category.show',['subcat' => $subcat]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $category = Category::get();
        $subcat = SubCategories::get();

        return view('subcategory.create',['subcat'=> $subcat, 'category'=>$category]);

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
            'cat'=> 'required',
            'cat_title' => 'required',
        ]);

        $subcat = new SubCategories;


        $subcat->category_id = $request->input('cat');
        $subcat->name = $request->input('cat_title');
        $subcat->created_by  = Auth::user()->id;
        $subcat->save();
        return redirect()->route('categories')->with(['message'=> 'Successfully Added!!']);

    }

    public function showCatSubcat($id){
        $category = Category::find($id);
        $subCat = SubCategories::where('category_id',$id)->get();
        // dd(json_decode($subCat));
        return view('category.showSubCat')->with('subcat', $subCat);

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
        //
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
        $cat = SubCategories::find($id);

        $cat->delete();

        return redirect()->route('categories')->with(['message'=> 'Successfully Deleted Sub Category!!']);
    }
}
