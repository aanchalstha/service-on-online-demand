<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\ServiceRequests;
use App\ServiceProviders;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $servicerequest =DB::table('service_requests as sr')
                             ->select('sr.*','s.name as service_name','s.service_time as duration','u.name as member_name',
                             'c.name as category_name','p.name as service_provider')
                             ->join('services as s','s.id','=','sr.service_id')
                             ->join('service_categories as c','c.id','=','s.category_id')
                             ->leftJoin('service_providers as p','sr.service_provider_id','=','p.id')
                             ->leftJoin('members as m','m.id','=','sr.member_id')
                             ->leftJoin('users as u','u.id','=','m.user_id')
                              ->get();

        return view('admin.index',['datas' => $servicerequest]);
    }

    public function editServiceRequest($id){

        $data = DB::table('service_requests as sr')
                    ->select('sr.*','s.name as service_name','s.category_id','s.service_time as duration','u.name as member_name',
                    'c.name as category_name','p.name as service_provider')
                    ->join('services as s','s.id','=','sr.service_id')
                    ->join('service_categories as c','c.id','=','s.category_id')
                    ->leftJoin('service_providers as p','sr.service_provider_id','=','p.id')
                    ->leftJoin('members as m','m.id','=','sr.member_id')
                    ->leftJoin('users as u','u.id','=','m.user_id')
                    ->where('sr.id',$id) ->get()->first();

        $category_id = $data->category_id;
        $serviceproviders = DB::table('service_providers')->where([['category_id',$category_id]])->get();

       return view('admin.editservicerequests',['data' => $data, 'serviceproviders' =>$serviceproviders]);
    }
    public function updateServiceRequest(Request $request, $id){

      $service_provider_data_to_update = [];
      $service_provider_data_to_update['service_provider_id'] = $request->provider_id;
      $service_provider_data_to_update['isCompleted'] = $request->is_completed;
      $service_provider_data_to_update['has_paid'] = $request->has_paid;

      $status = ServiceRequests::where('id',$id)->update($service_provider_data_to_update);

      if($request->is_completed == 1){
        $service_provider_id = DB::table('service_requests')->where('id',$id)->pluck('service_provider_id')->first();
        $provider = ServiceProviders::find( $service_provider_id );
        $provider->available = 1;
        $provider->service_count += 1;
        $provider->update();
      }elseif($request->is_completed == 0){
        $service_provider_id = DB::table('service_requests')->where('id',$id)->pluck('service_provider_id')->first();
        $provider = ServiceProviders::find( $service_provider_id );
        $provider->available = 0;
        $provider->update();
      }



      if($status){
        return redirect()->route('home')->with(['message'=> 'Service Request Updated Successfully!!']);
    }
    else{
        return redirect()->route('home')->with(['error'=> 'Error While Updating Service Request. Please Try Again!!']);
    }
    }

    public function destroy($id){
        $service = ServiceRequests::find($id);
        $service->delete();
        return redirect()->back()->with(['error'=> 'Service Requests Successfully Deleted!!']);
    }
}
