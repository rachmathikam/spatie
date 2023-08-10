<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;
use DB;
use App\Models\User;



class RoleController extends Controller
{
    public function index(){

          $role = Role::where('name', '<>', 'admin')->get();
        return view('role',compact('role'));
    }

    public function create(){

          $role = Role::where('name', '<>', 'admin')->get();
          $permission = Permission::all();
        return view('role_create',compact('role','permission'));
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required',
            'permission' => 'nullable'
        ]);

        $roles = Role::create($request->all());
        $role  = Role::where('name', $roles->name)->first();

        // dd($request->permission);

        $test = Permission::whereIn('name',$request->permission)->select('id')->get();

        foreach ($test as $value) {
            $permissions  = Permission::where('id',$value->id)->first();
            $role->givePermissionTo([$permissions->id]);
        }

        return redirect()->route('role')->with('success','role berhasil di tambahkan');

    }

    public function edit($id, User $user){

        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        return view('role_edit',compact('role','permissions','user'));
    }

    public function update(Request $request){

        $request->validate([
            'role' => 'required',
            'permissions' => 'nullable'
        ]);
        // dd($request->all());
        $role = Role::where('name',$request->role)->first();
        if ($role->permissions->isEmpty()) {
            $role = Role::findOrFail($request->id);
            $role->update([
                'name' => $request->role]);
            $test = Permission::whereIn('name',$request->permissions)->select('id')->get();

            foreach ($test as $value) {
                $permissions  = Permission::where('id',$value->id)->first();
                $role->givePermissionTo([$permissions->id]);
            }
        } else {
            // Role has permissions assigned
            // Your code here
        }

        return redirect()->route('role')->with('success','role berhasil di tambahkan');

    }

    public function delete($id){


        $role = Role::findOrfail($id);
        $role->users()->detach();
        $role->delete();
        return redirect()->route('role')->with('success','role berhasil di tambahkan');

    }
}
