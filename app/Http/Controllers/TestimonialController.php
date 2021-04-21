<?php

namespace App\Http\Controllers;
use App\Testimonials;
use Illuminate\Http\Request;
use Image;
use File;
use DB;
use Auth;
use App\ServiceRequests;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = Testimonials::all();


        return view('customer.testimonials.index',['testimonials' => $testimonials]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = DB::table('service_requests as sr')
                        ->select('sr.*','s.name as service_name','s.service_time as duration','c.name as category_name','p.name as service_provider')
                        ->join('services as s','s.id','=','sr.service_id')
                        ->join('service_categories as c','c.id','=','s.category_id')
                        ->leftJoin('service_providers as p','sr.service_provider_id','=','p.id')
                        ->where('sr.isCompleted',1)->get();

        return view('customer.testimonials.create',['services' => $services]);
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
            'position'=> 'required',
            'text'=> 'required',
            'service_request_id' => 'required',
            'status'=> 'required',
        ]);

        if($request->hasFile('image')) {

            $file = $request->file('image');

            $extension = $file->getClientOriginalExtension();
            $filename = date("Y_m_d_H_m_s") . '_testimonial.'.$extension;
            $img = Image::make($request->file('image'))->resize(600, 500)->save('uploads/testimonials/'.$filename, 60);

        } else {

            $filename = "noimage.jpg";
        }

        $testimonial_data_to_store['name'] = $request->name;
        $testimonial_data_to_store['image'] = $filename;
        $testimonial_data_to_store['position'] = $request->position;
        $testimonial_data_to_store['text'] = $request->text;
        $testimonial_data_to_store['service_request_id'] = $request->service_request_id;
        $testimonial_data_to_store['status'] = $request->status;

        $status = DB::table('testimonials')->insert($testimonial_data_to_store);

        if($status){
            return redirect()->route('view.testimonial')->with(['message'=> 'Feedback/Review Successfully Added!!']);
        }
        else{
            return redirect()->route('view.testimonial')->with(['error'=> 'Error While Adding Feedback/Review!!']);
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
        $testimonial = Testimonials::find($id);
        $services = DB::table('service_requests as sr')
                        ->select('sr.*','s.name as service_name','s.service_time as duration','c.name as category_name','p.name as service_provider')
                        ->join('services as s','s.id','=','sr.service_id')
                        ->join('service_categories as c','c.id','=','s.category_id')
                        ->leftJoin('service_providers as p','sr.service_provider_id','=','p.id')
                        ->where('sr.isCompleted',1)->get();
        return view('customer.testimonials.edit',['data'=> $testimonial, 'services' => $services]);
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
            'position'=> 'required',
            'text'=> 'required',
            'service_request_id' => 'required',
            'status'=> 'required',
        ]);
        $data = Testimonials::find($id);

        if($request->hasFile('image')) {

            $file = $request->file('image');

            if($data->image !='noimage.jpg'){
                //delete Image
                File::delete('uploads/testimonials/'.$data->image);
            }
            $extension = $file->getClientOriginalExtension();
            $filename = date("Y_m_d_H_m_s") . '_testimonial.'.$extension;
            $img = Image::make($request->file('image'))->resize(600, 500)->save('uploads/testimonials/'.$filename, 60);

        } else {

            $filename = Testimonials::where('id',$id)->pluck('image')->first();
        }

        $testimonial_data_to_update['name'] = $request->name;
        $testimonial_data_to_update['image'] = $filename;
        $testimonial_data_to_update['position'] = $request->position;
        $testimonial_data_to_update['text'] = $request->text;
        $testimonial_data_to_update['service_request_id'] = $request->service_request_id;
        $testimonial_data_to_update['status'] = $request->status;

        $status = Testimonials::where('id',$id)->update($testimonial_data_to_update);

        if($status){
            return redirect()->route('view.testimonial')->with(['message'=> 'Feedback/Review Successfully Updated!!']);
        }
        else{
            return redirect()->route('view.testimonial')->with(['error'=> 'Error While Updating Feedback/Review!!']);
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
        $testimonial = Testimonials::find($id);
        if($testimonial->image !='noimage.jpg'){
            //delete Image
            File::delete('uploads/testimonials/'.$testimonial->image);
        }
        // dd($product);
        $testimonial->delete();
        return redirect()->back()->with(['error'=> 'Feedback/Review Successfully Deleted!!']);
    }
}
