<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use DB;
use Hash;
use Auth;
use Kodeine\Acl\Models\Eloquent\Role;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    public function create()
    {

        $roles=Role::all()->lists('name','id');
        return view('users.create')->with('roles',$roles);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        foreach ($request->input('roles') as $key => $value) {
            $user->assignRole($value);
        }

        return redirect()->route('admin.users.index')->with('success','User created successfully');
    }


    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }


    public function edit_profile()
    {
        $user = Auth::user();
        return view('portal.edit_profile')->with('user',$user);
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles=Role::all()->lists('name','id');
        return view('users.edit')->with('user',$user)->with('roles',$roles);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();

        $user = User::find($id);
        $user->update($input);

        foreach ($request->input('roles') as $key => $value) {
            $user->syncRoles($value);
        }

        return redirect()->route('admin.users.index')
                        ->with('success','User updated successfully');
    }


    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('admin.users.index')
                        ->with('success','User deleted successfully');
    }
}