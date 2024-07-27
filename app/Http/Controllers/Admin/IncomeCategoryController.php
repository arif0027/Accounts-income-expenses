<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IncomeCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class IncomeCategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $all = IncomeCategory::where('incate_status',1)->orderBy('incate_id', 'DESC')->get();
        return view('admin.incomeCategory.all',compact('all'));
    }

    public function add(){
        return view('admin.incomeCategory.add');
    }

    public function edit($slug){
        $data=IncomeCategory::where('incate_status',1)->where('incate_slug',$slug)->firstOrFail();
        return view('admin.incomeCategory.edit',compact('data'));
    }

    public function view($slug){
        $data=IncomeCategory::where('incate_status',1)->where('incate_slug',$slug)->firstOrFail();
        return view('admin.incomeCategory.view',compact('data'));
    }
    public function insert(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'remarks'=>'required',
          ],[
            'name.required'=>'Please enter incomeCategory name.',
            'remarks.required'=>'Please enter incomeCategory remarks.',
          ]);

          $slug='B'.uniqid();
          $creator=Auth::user()->id;

          $insert=IncomeCategory::insertGetId([
            'incate_name'=>$request['name'],
            'incate_remarks'=>$request['remarks'],
            'incate_creator'=>$creator,
            'incate_slug'=>$slug,
            'created_at'=>Carbon::now()->toDateTimeString(),
          ]);

          if($insert){
            Session::flash('success','Successfully upload IncomeCategory information');
            return redirect('dashboard/incomeCategory/add');
          }else{
            Session::flash('error','Opps!! operation failed');
            return redirect('dashboard/incomeCategory/add');
          }
    }

    public function update(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'remarks'=>'required',
          ],[
            'name.required'=>'Please enter incomeCategory name.',
            'remarks.required'=>'Please enter incomeCategory remarks.',
          ]);

            $id = $request['id'];
            $slug = $request['slug'];

            $update=IncomeCategory::where('incate_id', $id)->update([
            'incate_name' => $request->name,
            'incate_remarks' => $request->remarks,
            'incate_editor' => Auth::user()->id,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        if($update){
          Session::flash('success','Successfully update IncomeCategory information');
          return redirect('dashboard/incomeCategory/view/'.$slug);
        }else{
          Session::flash('error','Opps! Operation failed.');
          return redirect('dashboard/incomeCategory/edit/'.$slug);
        }
    }

    public function softdelete(){
        $id = $_POST['modal_id'];
        $softdelete=IncomeCategory::where('incate_status',1)->where('incate_id',$id)->update([
            'incate_status'=>0,
            'updated_at'=>Carbon::now()->toDateTimeString(),
          ]);

          if($softdelete){
            Session::flash('success','Successfully delete incomeCategory information');
            return redirect('dashboard/incomeCategory');
          }else{
            Session::flash('error','Opps!! operation failed');
            return redirect('dashboard/incomeCategory');
          }
    }

    public function restore(){
        $id = $_POST['modal_id'];
        $restore=IncomeCategory::where('incate_status',0)->where('incate_id',$id)->update([
            'incate_status'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
          ]);

          if($restore){
            Session::flash('success','Successfully restore income category information');
            return redirect('dashboard/recycle/income/category');
          }else{
            Session::flash('error','Opps!! operation failed');
            return redirect('dashboard/recycle/income/category');
          }
    }

    public function delete(){
        $id = $_POST['modal_id'];
        $delete=IncomeCategory::where('incate_status',0)->where('incate_id',$id)->delete([]);

          if($delete){
            Session::flash('success','Successfully permanently delete incomeCategory information');
            return redirect('dashboard/recycle/income/category');
          }else{
            Session::flash('error','Opps!! operation failed');
            return redirect('dashboard/recycle/income/category');
          }
    }

}
