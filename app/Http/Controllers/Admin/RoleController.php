<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
      }

      public function index(){
        $all=Role::where('role_status',1)->orderBy('role_id','DESC')->get();
        return view('admin.role.all',compact('all'));
      }

      public function add(){
        return view('admin.role.add');
      }

      public function edit($slug){
        $data=Role::where('role_status',1)->where('role_slug',$slug)->firstOrFail();
        return view('admin.role.edit',compact('data'));
      }

      public function view($slug){
        $data=Role::where('role_status',1)->where('role_slug',$slug)->firstOrFail();
        return view('admin.role.view',compact('data'));

      }

      public function insert(Request $request){

         $slug='R'.uniqid();
         $creator=Auth::user()->id;

        $insert = Role::insert([
          'role_name'=>$request['name'],
          'role_remarks'=>$request['remarks'],
          'role_creator'=>$creator,
          'role_slug'=>$slug,
          'created_at'=>Carbon::now()->toDateTimeString(),
      ]);

      if($insert){
        Session::flash('success!','Successfully upload role information');
        return redirect('dashboard/role');
      }else{
        Session::flash('error','Opps! upload failed.');
        return redirect('dashboard/role/add');
      }

      }

      public function update(Request $request){

        $id = $request['id'];
        $slug = $request['slug'];

        $insert = Role::where('role_slug', $slug)->update([
          'role_name' => $request->name,
          'role_remarks' => $request->remarks,
          'role_editor' => Auth::user()->id,
          'updated_at' => Carbon::now()->toDateTimeString(),

        ]);

        if($insert){
          Session::flash('success','Successfully update role information');
          return redirect('dashboard/role/view/'.$slug);
        }else{
          Session::flash('error','Opps! Operation failed.');
          return redirect('dashboard/role/edit/'.$slug);
        }

      }

      public function softdelete(){
        $id=$_POST['modal_id'];
        $softdelete=Role::where('role_status',1)->where('role_id',$id)->update([
          'role_status'=>0,
        'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);

        if($softdelete){
          Session::flash('success','Successfully delete role information.');
          return redirect('dashboard/role');
        }else{
          Session::flash('error','Opps! Operation failed.');
          return redirect('dashboard/role');
        }

      }

      public function restore(){

      }

      public function delete(){

      }
}
