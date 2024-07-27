<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExpenseCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ExpenseCategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $all = ExpenseCategory::where('expcate_status',1)->orderBy('expcate_id', 'DESC')->get();
        return view('admin.expenseCategory.all',compact('all'));
    }

    public function add(){
        return view('admin.expenseCategory.add');
    }

    public function edit($slug){
        $data=ExpenseCategory::where('expcate_status',1)->where('expcate_slug',$slug)->firstOrFail();
        return view('admin.expenseCategory.edit',compact('data'));
    }

    public function view($slug){
        $data=ExpenseCategory::where('expcate_status',1)->where('expcate_slug',$slug)->firstOrFail();
        return view('admin.expenseCategory.view',compact('data'));
    }
    public function insert(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'remarks'=>'required',
          ],[
            'name.required'=>'Please enter expenseCategory name.',
            'remarks.required'=>'Please enter expenseCategory remarks.',
          ]);

          $slug='B'.uniqid();
          $creator=Auth::user()->id;

          $insert=ExpenseCategory::insertGetId([
            'expcate_name'=>$request['name'],
            'expcate_remarks'=>$request['remarks'],
            'expcate_creator'=>$creator,
            'expcate_slug'=>$slug,
            'created_at'=>Carbon::now()->toDateTimeString(),
          ]);

          if($insert){
            Session::flash('success','Successfully upload ExpenseCategory information');
            return redirect('dashboard/expenseCategory/add');
          }else{
            Session::flash('error','Opps!! operation failed');
            return redirect('dashboard/expenseCategory/add');
          }
    }

    public function update(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'remarks'=>'required',
          ],[
            'name.required'=>'Please enter expenseCategory name.',
            'remarks.required'=>'Please enter expenseCategory remarks.',
          ]);

            $id = $request['id'];
            $slug = $request['slug'];

            $update=ExpenseCategory::where('expcate_id', $id)->update([
            'expcate_name' => $request->name,
            'expcate_remarks' => $request->remarks,
            'expcate_editor' => Auth::user()->id,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        if($update){
          Session::flash('success','Successfully update ExpenseCategory information');
          return redirect('dashboard/expenseCategory/view/'.$slug);
        }else{
          Session::flash('error','Opps! Operation failed.');
          return redirect('dashboard/expenseCategory/edit/'.$slug);
        }
    }

    public function softdelete(){
        $id = $_POST['modal_id'];
        $softdelete=ExpenseCategory::where('expcate_status',1)->where('expcate_id',$id)->update([
            'expcate_status'=>0,
            'updated_at'=>Carbon::now()->toDateTimeString(),
          ]);

          if($softdelete){
            Session::flash('success','Successfully delete expense category information');
            return redirect('dashboard/expenseCategory');
          }else{
            Session::flash('error','Opps!! operation failed');
            return redirect('dashboard/expenseCategory');
          }
    }

    public function restore(){
        $id = $_POST['modal_id'];
        $restore=ExpenseCategory::where('expcate_status',0)->where('expcate_id',$id)->update([
            'expcate_status'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
          ]);

          if($restore){
            Session::flash('success','Successfully restore expense category information');
            return redirect('dashboard/recycle/expense/category');
          }else{
            Session::flash('error','Opps!! operation failed');
            return redirect('dashboard/recycle/expense/category');
          }
    }

    public function delete(){
        $id = $_POST['modal_id'];
        $delete=ExpenseCategory::where('expcate_status',0)->where('expcate_id',$id)->delete([]);

          if($delete){
            Session::flash('success','Successfully permanently delete expense category information');
            return redirect('dashboard/recycle/expense/category');
          }else{
            Session::flash('error','Opps!! operation failed');
            return redirect('dashboard/recycle/expense/category');
          }
    }
}
