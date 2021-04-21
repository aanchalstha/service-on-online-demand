<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServiceProviders;
use App\Category;
use Image;
use File;
use DB;

class ServiceProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serviceproviders = DB::table('service_providers as s')
                                ->select('s.*','c.name as category_name')
                                ->join('service_categories as c','c.id','=','s.category_id')
                                ->get();
        return view('admin.serviceprovider.index',['serviceproviders' => $serviceproviders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('admin.serviceprovider.create',['category' => $category]);
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
            'name' => 'required',
            'image' => 'image|required',
            'description'=> 'required',
            'category_id'=> 'required',
            'status'=> 'required',
            'rate'=> 'required',
        ]);

        if($request->hasFile('image')) {

            $file = $request->file('image');

            $extension = $file->getClientOriginalExtension();
            $filename = date("Y_m_d_H_m_s") . '_testimonial_author.'.$extension;
            $img = Image::make($request->file('image'))->resize(600, 500)->save('uploads/serviceproviders/'.$filename, 60);

        } else {

            $filename = "noimage.jpg";
        }

        $testimonial_data_to_store['name'] = $request->name;
        $testimonial_data_to_store['image'] = $filename;
        $testimonial_data_to_store['category_id'] = $request->category_id;
        $testimonial_data_to_store['description'] = $request->description;
        $testimonial_data_to_store['rate'] = $request->rate;
        $testimonial_data_to_store['status'] = $request->status;

        $status = ServiceProviders::create($testimonial_data_to_store);

        if($status){
            return redirect()->route('service-provider.index')->with(['message'=> 'Service Provider Successfully Added!!']);
        }
        else{
            return redirect()->route('service-provider.index')->with(['error'=> 'Error While Adding Service Provider!!']);
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
        $serviceprovider = ServiceProviders::find($id);
        $category = Category::all();
        return view('admin.serviceprovider.edit',['data' => $serviceprovider, 'category'=>$category]);
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
            'name' => 'required',
            'description'=> 'required',
            'category_id'=> 'required',
            'status'=> 'required',
            'rate'=> 'required',
        ]);
        $provider = ServiceProviders::find($id);
        if($request->hasFile('image')) {

            $file = $request->file('image');
            if($provider->image !='noimage.jpg'){
                //delete Image
                File::delete('uploads/serviceproviders/'.$provider->image);
            }
            $extension = $file->getClientOriginalExtension();
            $filename = date("Y_m_d_H_m_s") . '_testimonial_author.'.$extension;
            $img = Image::make($request->file('image'))->resize(600, 500)->save('uploads/serviceproviders/'.$filename, 60);

        } else {

            $filename = ServiceProviders::where('id',$id)->pluck('image')->first();
        }

        $testimonial_data_to_update['name'] = $request->name;
        $testimonial_data_to_update['image'] = $filename;
        $testimonial_data_to_update['category_id'] = $request->category_id;
        $testimonial_data_to_update['description'] = $request->description;
        $testimonial_data_to_update['rate'] = $request->rate;
        $testimonial_data_to_update['status'] = $request->status;

        $status = ServiceProviders::where('id',$id)->update($testimonial_data_to_update);

        if($status){
            return redirect()->route('service-provider.index')->with(['message'=> 'Service Provider Successfully Updated !!']);
        }
        else{
            return redirect()->route('service-provider.index')->with(['error'=> 'Error While Updating Service Provider!!']);
        }
    }

    public function sortAscending(){
        $serviceproviders = DB::table('service_providers as s')
        ->select('s.*','c.name as category_name')
        ->join('service_categories as c','c.id','=','s.category_id')
        ->orderBy('created_at', 'desc')->get();

        return view('admin.serviceprovider.index',['serviceproviders' => $serviceproviders]);
    }

    public function sortDescending(){
        $serviceproviders = DB::table('service_providers as s')
        ->select('s.*','c.name as category_name')
        ->join('service_categories as c','c.id','=','s.category_id')
        ->orderBy('created_at', 'asc')->get();

        return view('admin.serviceprovider.index',['serviceproviders' => $serviceproviders]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = ServiceProviders::find($id);
        if($service->image !='noimage.jpg'){
            //delete Image
            File::delete('uploads/serviceproviders/'.$service->image);
        }
        // dd($product);
        $service->delete();
        return redirect()->back()->with(['error'=> 'Service Provider Successfully Deleted!!']);
    }
}
