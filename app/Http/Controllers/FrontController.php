<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BannerImage;
use App\Category;
use App\Testimonials;
use App\Services;
use DB;
use App\ServiceProviders;
use App\ServiceRequests;

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
    public function sortCatAscending()
    {
        $services = DB::table('services as s')
                        ->select('s.*','c.name as category')
                        ->join('service_categories as c','s.category_id','=','c.id')
                        ->where('s.status', 1)->get();
        $category = Category::orderBy('name', 'ASC')->get();

        return view('home.services',['services'=> $services, 'categories' =>$category]);
    }

    public function sortCatDescending()
    {
        $services = DB::table('services as s')
                        ->select('s.*','c.name as category')
                        ->join('service_categories as c','s.category_id','=','c.id')
                        ->where('s.status', 1)->get();
        $category = Category::orderBy('name', 'DESC')->get();

        return view('home.services',['services'=> $services, 'categories' =>$category]);
    }

    public function services()
    {
        $services = DB::table('services as s')
                        ->select('s.*','c.name as category')
                        ->join('service_categories as c','s.category_id','=','c.id')
                        ->where('s.status', 1)->get();
        $category = Category::all();

        return view('home.services',['services'=> $services, 'categories' =>$category]);
    }

    public function admin(){
        return view('home.register');
    }

    public function about(){

        return view('home.about');
    }

    public function testimonial(){
        $testimonial = DB::table('testimonials as t')
                            ->select('t.*','sr.service_id','s.name as service_name')
                            ->join('service_requests as sr','sr.id','=','t.service_request_id')
                            ->join('services as s','s.id','=','sr.service_id')
                            ->get();
        return view('home.testimonial',['testimonials' => $testimonial]);
    }
    public function contact(){

        return view('home.contact');
    }

    public function serviceProviders(){
        $providers = DB::table('service_providers as sp')
                        ->select('sp.*','c.name as category')
                        ->join('service_categories as c','c.id','=','sp.category_id')
                        ->where('sp.status',1)->get();
        $max_service_count = ServiceProviders::max('service_count');

        return view('home.serviceprovider',['providers'=> $providers,'max_service_count'=>$max_service_count]);
    }

    public function favServiceProvider($id){
        $data = ServiceProviders::find($id);
        $services = DB::table('service_requests as sr')
                        ->select('sr.id','s.*')
                        ->join('services as s','s.id','=','sr.service_id')
                        ->where('sr.service_provider_id',$id)->get();

        return view('home.favserviceprovider',['data' => $data,'services'=>$services]);
    }

    public function catServices($id){
        $services = Services::where('category_id', $id)->get();
        $category = Category::all();
        return view('home.services',['services'=> $services, 'categories' =>$category]);
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
