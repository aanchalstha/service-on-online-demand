<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\SubCategories;
use Auth;
use DB;
class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $subcat = DB::table('sub_categories as s')
                    ->select('s.*','c.*','c.name as category_name','s.id as subcat_id','s.name as subcat_name')
                    ->join('service_categories as c','c.id','=','s.category_id')
                    ->get();
        return view('subcategory.show',['subcat' => $subcat]);
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

        $subcat->save();
        return redirect()->route('subcategories')->with(['message'=> 'Successfully Added!!']);

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

        return redirect()->route('subcategories')->with(['message'=> 'Successfully Deleted Sub Category!!']);
    }
}
