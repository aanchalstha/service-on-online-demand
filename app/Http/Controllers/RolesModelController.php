<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRolesRequest;
use App\Http\Requests\Admin\UpdateRolesRequest;
use DB;



class RolesModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (! Gate::allows('roles.view')) {
        //     return abort(401);
        // }
        $roles = Role::all();

        return view('admin.roles.index', compact('roles'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if (! Gate::allows('roles.add')) {
        //     return abort(401);
        // }

        $permissions = Permission::get()->pluck('name', 'name');

        return view('admin.roles.create', compact('permissions'));
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
            'name'=>'required',
        ]);

        try {
            DB::beginTransaction();

            $count = Role::where('name', $request->name)->count();
            if($count == 0) {

            $role = Role::create(['name' => $request->name]);
            $permissions = $request->input('permission') ? $request->input('permission') : [];

                if(!empty($permissions)) {
                    $role->syncPermissions($permissions);

                }
            DB::commit();
            return redirect()->route('roles.view')->with(['message'=> 'Role Successfully Created!!']);
            }
            else{
                return redirect()->route('roles.view')->with(['error'=> 'Role Already Exists!!']);
            }
         }
        catch(Exception $ex) {
            DB::rollback();

        }

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\RolesModel  $rolesModel
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $role = Role::findorfail($id);
        $role->load('permissions');

        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RolesModel  $rolesModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // if (! Gate::allows('roles.edit')) {
        //     return abort(401);
        // }
        $role = Role::findorfail($id);
        $permissions = Permission::get()->pluck('name', 'name');


        return view('admin.roles.edit', compact('role', 'permissions'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RolesModel  $rolesModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request->input('name'));
        $this->validate($request,[
            'name'=>'required',
        ]);
        $name = $request->input('name');
        $permissions = $request->input('permission') ? $request->input('permission') : [];


        try {
            DB::beginTransaction();
            $role = Role::findorfail($request->id);
            $status = Role::where('name', $role->name)->update(['name' => $request->name]);

            if(!empty($permissions)) {
                    $role->syncPermissions($permissions);

                }
            DB::commit();
            return redirect()->route('roles.view')->with(['message'=> 'Role Successfully Updated!!']);
            }


        catch(Exception $ex) {
            DB::rollback();

    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RolesModel  $rolesModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if (! Gate::allows('roles.delete')) {
        //     return abort(401);
        // }
        $role = Role::findorfail($id);
        $role->delete();

      return redirect()->route('roles.view')->with(['error'=> 'Right Successfully Deleted!!']);
    }
}
