<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services;
use App\Category;
use Image;
use File;
use DB;
use Auth;
use Illuminate\Support\Str;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $service = DB::table('services as s')
                      ->select('s.*','s.image as service_image','c.name as category_name')
                      ->leftjoin('service_categories as c','s.category_id','=','c.id')
                      ->get();
        return view('admin.service.index',['services' => $service]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::where('status',1)->get();

       return view('admin.service.create',['category' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'service_name'=>'required',
            'image'=>'required',
            'category_id'=>'nullable',
            'service_fee'=>'required',
            'description'=>'required',
            'other_information'=>'required'
        ]);

         if($request->hasFile('image')) {
             $file = $request->file('image');
             $extension = $file->getClientOriginalExtension();
             $filename = time(). '_courses.' .$extension;
             $img = Image::make($request->file('image'))->resize(800,800)->save('uploads/services/'.$filename, 60);
         } else {
             $filename = "noimage.jpg";
         }
         $slug = Str::slug($request->service_name);
         $course_data_to_insert = [];

         $service_data_to_insert['name'] = $request->service_name;
         $service_data_to_insert['image'] = $filename;
         $service_data_to_insert['slug'] = $slug;
         $service_data_to_insert['category_id'] = $request->category_id;

         $service_data_to_insert['service_charge'] = $request->service_fee;
         $service_data_to_insert['service_time'] = $request->service_time ?? null;
         $service_data_to_insert['description'] = $request->description;
         $service_data_to_insert['other_information'] = $request->other_information;
         $service_data_to_insert['status'] = $request->status;


         $duplicate = Services::where('slug', $slug)->first();
         if ($duplicate) {
           return redirect()->route('service.index')->with(['error'=> 'Title Already Exists']);
         }

         $status = Services::create($service_data_to_insert);

         if($status){
             return redirect()->route('service.index')->with(['message'=> 'Service Information Successfully Added!!']);
         }
         else{
             return redirect()->route('service.index')->with(['error'=> 'Error While Adding Service. Please Try Again!!']);
         }
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
        $service = Services::find($id);
        $category = Category::where('status',1)->get();


        return view('admin.service.edit',[ 'service' => $service, 'category' => $category]);
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

        $this->validate($request, [
            'service_name'=>'required',
            'category_id'=>'nullable',
            'service_fee'=>'required',
            'description'=>'required',
            'other_information'=>'required'
        ]);
        $service = Services::find($id);
         if($request->hasFile('image')) {
            if($service->image !='noimage.jpg'){
                //delete Image
                File::delete('uploads/services/'.$service->image);
            }
             $file = $request->file('image');
             $extension = $file->getClientOriginalExtension();
             $filename = time(). '_courses.' .$extension;
             $img = Image::make($request->file('image'))->resize(800,800)->save('uploads/services/'.$filename, 60);
         } else {
             $filename =  Services::where('id',$id)->pluck('image')->first();
         }
         $course_data_to_insert = [];

         $service_data_to_update['name'] = $request->service_name;
         $service_data_to_update['image'] = $filename;
         $service_data_to_update['category_id'] = $request->category_id;
         $service_data_to_update['service_charge'] = $request->service_fee;
         $service_data_to_update['service_time'] = $request->service_time ?? null;
         $service_data_to_update['description'] = $request->description;
         $service_data_to_update['other_information'] = $request->other_information;
         $service_data_to_update['status'] = $request->status;


         $status = Services::where('id', $id)->update($service_data_to_update);

         if($status){
             return redirect()->route('service.index')->with(['message'=> 'Service Information Successfully Updated !!']);
         }
         else{
             return redirect()->route('service.index')->with(['error'=> 'Error While Updating Service. Please Try Again!!']);
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Services::find($id);
        if($service->image !='noimage.jpg'){
            //delete Image
            File::delete('uploads/services/'.$service->image);
        }
        // dd($product);
        $service->delete();
        return redirect()->back()->with(['error'=> 'Service Information Successfully Deleted!!']);

    }
}
