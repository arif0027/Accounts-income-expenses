<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        // $this->middleware('superadmin');
      }

      public function index(){
        $all=User::all();
        return view('admin.user.all',compact('all'));
      }

      public function add(){
        return view('admin.user.add');
      }

      public function edit($id){
        $data=User::where('id', $id)->firstOrFail();
        return view('admin.user.edit',compact('data'));
      }

      public function view($id){
        $data=User::where('id',$id)->firstOrFail();
        return view('admin.user.view',compact('data'));

      }

      public function insert(Request $request){
        $this->validate($request,[
          'name'=>'required',
          'email'=>'required',
          'username'=>'required',
          'password'=>'required',
          'role'=>'required',
        ],[
          'name.required'=>'Please enter user name.',
          'email.required'=>'Please enter user email.',
          'username.required'=>'Please enter username.',
          'password.required'=>'Please enter user password.',
          'role.required'=>'Please select user role.',
        ]);

          $insert = User::insertGetId([
          'name' => $request['name'],
          'phone' => $request['phone'],
          'email' => $request['email'],
          'username' => $request['username'],
          'password' => Hash::make($request['password']),
          'role_id' => $request['role'],
          'created_at' => Carbon::now()->toDateTimeString(),
        ]);

        if($request->hasFile('pic')){
          $image=$request->File('pic');
          $imageName=$insert.'_'.time().'.'.$image->getClientOriginalExtension();
          Image::make($image)->resize(200,200)->save(base_path('public/uploads/user/'.$imageName));

          User::where('id',$insert)->update([
            'photo'=>$imageName,
            'updated_at'=>Carbon::now()->toDateTimeString(),
          ]);
        }

        if($insert){
          Session::flash('success','Successfully upload user information');
          return redirect('dashboard/user/add');
        }else{
          Session::flash('error','Opps! failed upload user information');
          return redirect('dashboard/user/add');
        }

      }

      public function update(Request $request){
        $this->validate($request,[
          'name'=>'required',
          'email'=>'required',
          'username'=>'required',
        ],[
          'name.required'=>'Please enter user name.',
          'email.required'=>'Please enter user email.',
          'username.required'=>'Please enter username.',
        ]);

        $id = $request['id'];

        $update=User::where('id', $id)->update([
          'name' => $request->name,
          'phone' => $request->phone,
          'email' => $request->email,
          'username' => $request->username,
          'role_id' => $request->role,
          'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        if($request->hasFile('pic')){
          $image=$request->File('pic');
          $imageName=$id.'_'.time().'.'.$image->getClientOriginalExtension();
          Image::make($image)->resize(200,200)->save(base_path('public/uploads/user/'.$imageName));

          User::where('id',$id)->update([
            'photo'=>$imageName,
            'updated_at'=>Carbon::now()->toDateTimeString(),
          ]);
        }

        if($update){
          Session::flash('success','Successfully update user information');
          return redirect('dashboard/user/');
        }else{
          Session::flash('error','Opps! Operation failed.');
          return redirect('dashboard/user/edit/');
        }

      }

      public function softdelete(){

        $id=$_POST['modal_id'];
        $softdelete=User::where('status',1)->where('id',$id)->update([
          'status'=>0,
        'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);

        if($softdelete){
          Session::flash('success','Successfully upload user information');
          return redirect('dashboard/user');
        }else{
          Session::flash('error','Opps! Operation failed.');
          return redirect('dashboard/user');
        }

      }

      public function restore(){

      }

      public function delete(){

      }

}
