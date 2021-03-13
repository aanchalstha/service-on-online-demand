<?php

namespace App\Http\Controllers;
use App\Testimonials;
use Illuminate\Http\Request;
use Image;
use File;
use DB;
use Auth;

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
        return view('admin.testimonials.index',['testimonials' => $testimonials]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.testimonials.create');
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
            'status'=> 'required',
        ]);

        if($request->hasFile('image')) {

            $file = $request->file('image');

            $extension = $file->getClientOriginalExtension();
            $filename = date("Y_m_d_H_m_s") . '_testimonial_author.'.$extension;
            $img = Image::make($request->file('image'))->resize(600, 500)->save('uploads/testimonials/'.$filename, 60);

        } else {

            $filename = "noimage.jpg";
        }

        $testimonial_data_to_store['name'] = $request->name;
        $testimonial_data_to_store['image'] = $filename;
        $testimonial_data_to_store['position'] = $request->position;
        $testimonial_data_to_store['text'] = $request->text;
        $testimonial_data_to_store['status'] = $request->status;

        $status = DB::table('testimonials')->insert($testimonial_data_to_store);

        if($status){
            return redirect()->route('view.testimonial')->with(['message'=> 'Testimonial Successfully Added!!']);
        }
        else{
            return redirect()->route('view.testimonial')->with(['error'=> 'Error While Adding Testimonial!!']);
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
        $testimonial = Testimonials::find($id);
        if($testimonial->image !='noimage.jpg'){
            //delete Image
            File::delete('uploads/testimonials/'.$testimonial->image);
        }
        // dd($product);
        $testimonial->delete();
        return redirect()->back()->with(['error'=> 'Testimonial Successfully Deleted!!']);
    }
}
