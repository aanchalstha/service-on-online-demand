<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services;
use DB;
use Auth;
use App\Members;
use App\ServiceRequests;
use App\ServiceProviders;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth_user_id = Auth::user()->id;
        $member_id = Members::where('user_id', $auth_user_id)->pluck('id')->first();

        $services = DB::table('service_requests as sr')
                        ->select('sr.*','s.name as service_name','c.name as category_name')
                        ->join('services as s','s.id','=','sr.service_id')
                        ->join('service_categories as c','c.id','=','s.category_id')
                        ->where('sr.member_id',$member_id)->get();
       return view('customer.index',['services' => $services]);
    }

    public function registerService($sid){
       $service = DB::table('services as s')
                    ->select('s.*','s.name as service_name','c.name as category_name')
                    ->leftjoin('service_categories as c','s.category_id','=','c.id')
                    ->where('s.id',$sid)->get()->first();

        return view('customer.requestservice',['service' => $service]);
    }
    public function viewSettings()
    {
        return view('customer.settings');
    }

    public function finalServiceRegister(Request $request){

        $this->validate($request,[
            'service_id'=> 'required',
            'service_location' => 'required',
            'service_description' => 'required',
            'service_date' => 'required',
        ]);

        $auth_user_id = Auth::user()->id;
        $member_id = Members::where('user_id', $auth_user_id)->pluck('id')->first();

        $category_id = Services::where('id',$request->service_id)->pluck('category_id')->first();
        $service_provider_id = ServiceProviders::where([['category_id',$category_id],['available',1]])->pluck('id')->first();

        $service_requests_data_to_insert = [];
        $service_requests_data_to_insert['service_id'] = $request->service_id;
        $service_requests_data_to_insert['service_location'] = $request->service_location;
        $service_requests_data_to_insert['description'] = $request->service_description;
        $service_requests_data_to_insert['service_date'] = $request->service_date;
        $service_requests_data_to_insert['service_provider_id'] = $service_provider_id;
        $service_requests_data_to_insert['member_id'] = $member_id;
        $service_requests_data_to_insert['price'] = Services::where('id', $request->service_id)->pluck('service_charge')->first();

        if(Auth::user()->usertype == 'admin'){
            return redirect()->route('home')->with(['error'=> 'Admin Users Cannot Place Order From the system !!']);
        }

        $status = ServiceRequests::create($service_requests_data_to_insert);
        if($status){

            $provider = ServiceProviders::find($service_provider_id);
            $provider->available = 0;
            $provider->update();

            return redirect()->route('customer.index')->with(['message'=> 'Service Request Placed Successfully. Please wait for the admin to approve them !!']);
        }
        else{
            return redirect()->route('customer.index')->with(['error'=> 'Error While Requesting Service. Please Try Again!!']);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewServiceRequests($id)
    {
        $data = DB::table('service_requests as sr')
                    ->select('sr.*','s.name as service_name','s.service_time as duration','c.name as category_name','p.name as service_provider')
                    ->join('services as s','s.id','=','sr.service_id')
                    ->join('service_categories as c','c.id','=','s.category_id')
                    ->leftJoin('service_providers as p','sr.service_provider_id','=','p.id')
                    ->where('sr.id',$id)->get()->first();
        return view('customer.servicedetails',['data' => $data]);
    }

    public function viewCompletedServices(){

        $auth_user_id = Auth::user()->id;
        $member_id = Members::where('user_id', $auth_user_id)->pluck('id')->first();

        $services = DB::table('service_requests as sr')
                        ->select('sr.*','s.name as service_name','s.service_time as duration','c.name as category_name','p.name as service_provider')
                        ->join('services as s','s.id','=','sr.service_id')
                        ->join('service_categories as c','c.id','=','s.category_id')
                        ->leftJoin('service_providers as p','sr.service_provider_id','=','p.id')
                        ->where([['sr.isCompleted',1],['sr.member_id',$member_id]])->get();
       return view('customer.completedservices',['services' => $services]);
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
