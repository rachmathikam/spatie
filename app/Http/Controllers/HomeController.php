<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;
use DB;

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
        $id = Auth::id();

        if(Auth::user()->hasRole('admin')){
            $users = User::whereDoesntHave('roles', function ($query) {
                $query->where('name', 'admin');
            })->get();
        }else if(Auth::user()->hasRole('guru')){
            $users = User::where('id',$id)->get();
        }else{
            $users = User::where('id',$id)->get();
        }
        // dd($users);

        return view('home',compact('users'));
    }

    public function create(){

        $roles = Role::where('name', '<>', 'admin')->get();
        $permissions = Permission::get();
        return view('create',compact('roles','permissions'));
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required',
        ]);


       $user = User::create([
            'name'  => $request->name,
            'email'     =>  $request->email,
            'password'  => bcrypt($request->password),
        ]);

        $role  = Role::where('name', $request->role)->first();
        $user->assignRole([$role->id]);

        if($user){
                 return redirect()->route('home')->with('success','User berhasil di tambahkan');
        }else{
                 return redirect()->route('home')->with('error','User gagal di tambahkan');
        }
    }

    public function edit($id){
        $roles = Role::where('name', '<>', 'admin')->get();
        $users = User::findOrFail($id);
        $roleNames = $users->roles->pluck('name')->toArray();
        // dd($roleNames);

        return view('edit',compact('roles','users','roleNames'));
    }

    public function update(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'roles' => 'required',
            'id' => 'required',
        ]);

        $user = User::findOrFail($request->id);

        $user->update([
            'name'  => $request->name,
            'email'     =>  $request->email,
            'password'  => bcrypt($request->password),
        ]);

        $user->syncRoles($request->input('roles'));

        if($user){
            return redirect()->route('home')->with('success','User berhasil di tambahkan');
        }else{
            return redirect()->route('home')->with('failed','User gagal di tambahkan');
        }
    }

    public function delete($id){
        $data = User::where('id', $id)->first();
        $data->delete();
        if($data){
            return redirect()->route('home')->with('success','User berhasil di hapus');
        }else{
            return redirect()->route('home')->with('failed','User gagal di hapus');
        }
    }

    public function rolePermission(){
        $roles = Role::where('name', '<>', 'admin')->get();
        $permissions = Permission::all();
        return view('permission',compact('roles','permissions'));
    }

    public function addPermissionToRole(Request $request){
        $role   = Role::where('name', $request->role)->first();
        $test = Permission::whereIn('name',$request->permission)->select('id')->get();
        foreach ($test as $value) {
            $permissions  = Permission::where('id',$value->id)->first();
            $role->givePermissionTo([$permissions->id]);
        }

            return redirect()->route('home')->with('success','hak akses berhasil di tambah');





    }

}
