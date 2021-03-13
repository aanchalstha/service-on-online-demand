<?php

namespace App\Http\Controllers;

use App\BannerImage;
use App\Category;
use Image;
use File;
use DB;
use DataTables;


use Illuminate\Http\Request;

class BannerImageController extends Controller
{
   public function index(){
    $bannerImage= BannerImage::all();

    return view('banner.show',['banners'=>$bannerImage]);
   }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $bannerImage= BannerImage::all();

        return view('banner.create',['bannerImage' => $bannerImage]);
    }

   public function store(Request $request)
   {
        $data = new BannerImage;

        $this->validate($request, [
            'banner_title' => 'required',
            'banner_subtitle' => 'required',
            'image' => 'image|required',
                 ]);
        // dd($request->image);

        if($request->hasFile('image')) {
            // dd("success");
            $file = $request->file('image');
            // dd($file);
            $extension = $file->getClientOriginalExtension();
            $filename = time(). '_banner.' .$extension;
            $img = Image::make($request->file('image'))->resize(1000,431)->save('banner_uploads/'.$filename, 60);
            // dd($img);
        } else {
            // dd("fail");
            $filename = "noimage.jpg";
        }

        $data->banner_title = $request->banner_title;
        $data->banner_subtitle = $request->banner_subtitle;

        $data->image = $filename;
        $data->save();
        return redirect()->route('bannerImages')->with(['message'=> 'BannerImage Successfully Added!!']);

   }

   public function edit($id)
   {

        $banner = BannerImage::find($id);


       return view('banner.editBanner',['banner' => $banner]);
   }

   public function update(Request $request, $id)
   {
    $this->validate($request, [
        'banner_title' => 'required',
        'banner_subtitle' => 'required',
        'image' => 'image|nullable',

    ]);
        // dd($request->image);


        $data = BannerImage::find($id);



       if($request->hasFile('image')) {
           // dd("success");
           $file = $request->file('image');

           if($data->image !='noimage.jpg'){
            //delete Image
            File::delete('banner_uploads/'.$data->image);
        }

           $extension = $file->getClientOriginalExtension();
           $filename = date("Y_m_d_H_m_s") . '_banner.'.$extension;
           $img = Image::make($request->file('image'))->resize(1000,431)->save('banner_uploads/'.$filename, 60);
           // dd($img);
       } else {
           // dd("fail");
           $filename = BannerImage::where('id',$id)->pluck('image')->first();
       }
       $data->banner_title = $request->banner_title;
       $data->banner_subtitle = $request->banner_subtitle;

       $data->image = $filename;

       $data->update();
       return redirect()->route('bannerImages')->with(['message'=> 'BannerImage Successfully Updated!!']);
   }



   public function destroy($id)
   {

    $product = BannerImage::find($id);
       if($product->image !='noimage.jpg'){
           //delete Image
           File::delete('banner_uploads/'.$product->image);
       }
       // dd($product);
       $product->delete();
       return redirect()->back()->with(['error'=> 'BannerImage Successfully Deleted!!']);

   }
}
