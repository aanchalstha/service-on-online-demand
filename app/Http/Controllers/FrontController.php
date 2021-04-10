<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BannerImage;
use App\Category;
use App\Testimonials;
use App\Services;
use DB;
class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = BannerImage::all();
        $category = Category::all();
        $services = Services::where('status', 1)->get();
        $testimonial = Testimonials::where('status', '1')->get();
        return view('home.index',['banners' => $banners, 'category' =>$category, 'testimonials'=>$testimonial, 'services'=>$services]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function services()
    {
        $services = Services::where('status', 1)->get();
        $category = Category::all();

        return view('home.services',['services'=> $services, 'categories' =>$category]);
    }

    public function about(){

        return view('home.about');
    }

    public function testimonial(){
        $testimonial = Testimonials::where('status', '1')->get();
        return view('home.testimonial',['testimonials' => $testimonial]);
    }
    public function contact(){

        return view('home.contact');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
