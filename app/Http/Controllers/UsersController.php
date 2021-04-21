<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;
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
        $user = User::all();
        return view('admin.users.index',['users'=>$user]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
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
            'phone'=>'required',
            'password'=>'required',
        ]);
        $usertype = "admin";

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
            'phone' =>$request->phone,
            'usertype'=> $usertype,
            'password' => Hash::make($request->password),
        ]);

        if(!($user->id) > 0){
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findorfail($id);
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
        $user = User::findorfail($id);
        return view('admin.users.edit', compact('user'));
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
        ]);

        $user = User::where('id',$id)->get()->first();


        $user_data_to_insert = [];
        $user_data_to_insert['name'] =$request->name;
        $user_data_to_insert['email'] =$request->email;
        $user_data_to_insert['phone'] =$request->phone;
        $user_data_to_insert['usertype'] ='admin';
        $user_data_to_insert['password'] = Hash::make($request->password);

        try {
            DB::beginTransaction();
        $status = $user->update($user_data_to_insert);
        if(!($status)){
            DB::rollBack();
            return redirect()->route('users.index')->with(['error'=> 'An Error occured while updating the user information. Please Try Again']);
        }

        DB::commit();

        return redirect()->route('users.index')->with(['message'=> 'Users Information Updated Successfully!!']);


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
        $auth_id = Auth::user()->id;
        if( $id == $auth_id ){
            return redirect()->route('users.index')->with(['error'=> 'Logged In User Cannot Be Deleted!!']);
        }
        $users = User::findorfail($id);
        $users->delete();

        return redirect()->route('users.index')->with(['error'=> 'User Successfully Deleted!!']);
    }
}
