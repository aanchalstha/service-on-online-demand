<?php

namespace App\Http\Controllers;

use App\Rights;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RightsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $permissions = Permission::all();

        return view('admin.rights.index',['permissions'=>$permissions]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.rights.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $permission_name = $request->permission;
      $permission = Permission::create(['name' => $permission_name]);

      return redirect()->route('rights.view')->with(['message'=> 'Permission Successfully Created!!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rights  $rights
     * @return \Illuminate\Http\Response
     */
    public function show(Rights $rights)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rights  $rights
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // if (! Gate::allows('permissions.edit')) {
        //     return abort(401);
        // }
        $permission = Permission::findorfail($id);
        // dd($permission);
        return view('admin.rights.edit',['permission' => $permission]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rights  $rights
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'permission'=>'required',
        ]);

       $permission_data_to_update = [];
       $permission_data_to_update['id'] = $request->id;
       $permission_data_to_update['name'] = $request->permission;


        $status = Permission::where('id',$request->id)->update($permission_data_to_update);

        if($status){
            return redirect()->route('rights.view')->with(['message'=>'Permission Update Successful.']);
        }else{
            return redirect()->route('rights.view')->with(['error'=>'Permission Not Updated.']);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rights  $rights
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if (! Gate::allows('permissions.delete')) {
        //     return abort(401);
        // }
      $rights = Permission::findorfail($id);
      $rights->delete();

      return redirect()->route('rights.view')->with(['error'=> 'Permission Successfully Deleted!!']);
    }
}
