<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Spatie\Permission\Models\Role;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (! Gate::allows('users.view')) {
        //     return abort(401);
        // }
        $user = User::all();
        return view('admin.users.index',['users'=>$user]);

    }

    public function getData(){

        $user = User::all();
        $roles = Role::get()->pluck('name', 'name');

        return DataTables::of($user)

        ->addColumn('action', function($user){
            $btn = '<a href="'.route('users.view', $user->id).'" class="edit btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>&nbsp;';
            $btn = $btn.'<a href="'.route('users.edit', $user->id).'" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;';
            $btn = $btn.'<a href="'.route('users.delete', $user->id).'" class="edit btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>';

            return $btn;})
            ->addColumn('fullname', function($user){
                return $user->fname.' '.$user->lname;
             })
             ->addColumn('userroles', function($user){
                return $user->roles()->pluck('name')->first() ;
             })
            ->rawColumns(['action'])

            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if (! Gate::allows('users.add')) {
        //     return abort(401);
        // }
        $roles = Role::get()->pluck('name', 'name');

        return view('admin.users.create', compact('roles'));
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
            'email'=>'required',
            'password'=>'required',
            'roles'=>'required',

        ]);
        $usertype = "admin";

        // dd($data['fname']);
        try {
            DB::beginTransaction();

            $findByEmail = User::where('email', $request->email)->count();

            if($findByEmail>=1){
                DB::rollBack();
                return redirect()->route('users.index')->with(['error'=> 'User Already exists with that email address.!!']);
            }

            $user =  User::create([
            'name' => $request->name,
            'email' =>$request->email,
            'usertype'=> $usertype,
            'password' => Hash::make($request->password),
        ]);

        if(!($user->id) > 0){
            DB::rollBack();
            return redirect()->route('users.index')->with(['error'=> 'An Error occured while creating the user. Please Try Again']);
        }

        $roles = $request->input('roles') ? $request->input('roles') : [];
        $user->assignRole($roles);
        DB::commit();

        return redirect()->route('users.index')->with(['message'=> 'User Added Successfully!!']);


        }
        catch(Exception $ex)
        {

            DB::rollBack();
            return redirect()->route('users.index')->with(['error'=> 'An Error occured while creating the user. Please Try Again']);

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
        $user = User::findorfail($id);
        $user->load('roles');

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // if (! Gate::allows('users.edit')) {
        //     return abort(401);
        // }
        $user = User::findorfail($id);
        $roles = Role::get()->pluck('name', 'name');

        return view('admin.users.edit', compact('user', 'roles'));
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
            'name'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'password'=>'required',
            'roles'=>'required',

        ]);

        $user = User::where('id',$id)->get()->first();


        $user_data_to_insert = [];
        $user_data_to_insert['name'] =$request->name;
        $user_data_to_insert['email'] =$request->email;
        $user_data_to_insert['phone'] =$request->phone;
        $user_data_to_insert['usertype'] ='admin';
        $user_data_to_insert['password'] = Hash::make($request->password);
        // dd($user_data_to_insert);

        // dd($data['fname']);
        try {
            DB::beginTransaction();


        $status = $user->update($user_data_to_insert);
        $roles = $request->input('roles') ? $request->input('roles') : [];
        $user->syncRoles($roles);


        if(!($status)){
            DB::rollBack();
            return redirect()->route('users.index')->with(['error'=> 'An Error occured while creating the user. Please Try Again']);
        }

        DB::commit();

        return redirect()->route('users.index')->with(['message'=> 'User Added Successfully!!']);


        }
        catch(Exception $ex)
        {

            DB::rollBack();
            return redirect()->route('users.index')->with(['error'=> 'An Error occured while creating the user. Please Try Again']);

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
        // if (! Gate::allows('users.delete')) {
        //     return abort(401);
        // }
        $users = User::findorfail($id);
        $users->delete();

        return redirect()->route('users.index')->with(['error'=> 'User Successfully Deleted!!']);
    }
}
