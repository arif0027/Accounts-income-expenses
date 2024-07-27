<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Income;
use App\Models\IncomeCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class IncomeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('superadmin');
    }

    public function index(){
        $all = Income::where('income_status',1)->orderBy('income_id', 'DESC')->get();
        return view('admin.income.all',compact('all'));
    }

    public function add(){
        $categories = IncomeCategory::all();
        return view('admin.income.add',compact('categories'));
    }

    public function edit($slug){
        $data=Income::where('income_status',1)->where('income_slug',$slug)->firstOrFail();
        return view('admin.income.edit',compact('data'));
    }

    public function view($slug){
        $data=Income::where('income_status',1)->where('income_slug',$slug)->firstOrFail();
        return view('admin.income.view',compact('data'));
    }
    public function insert(Request $request){
        $this->validate($request,[
            'title'=>'required',
            'amount'=>'required',
            'date'=>'required',
          ],[
            'title.required'=>'Please enter income title.',
            'amount.required'=>'Please enter income amount.',
            'date.required'=>'Please enter income date.',
          ]);

          $slug='B'.uniqid();
          $creator=Auth::user()->id;

          $insert=Income::insertGetId([
            'income_title'=>$request['title'],
            'incate_id'=>$request['incate_id'],
            'income_amount'=>$request['amount'],
            'income_date'=>$request['date'],
            'income_creator'=>$creator,
            'income_slug'=>$slug,
            'created_at'=>Carbon::now()->toDateTimeString(),
          ]);

          if($insert){
            Session::flash('success','Successfully upload Income information');
            return redirect('dashboard/income/add');
          }else{
            Session::flash('error','Opps!! operation failed');
            return redirect('dashboard/income/add');
          }
    }

    public function update(Request $request){
        $this->validate($request,[
            'title'=>'required',
            'amount'=>'required',
            'date'=>'required',
          ],[
            'title.required'=>'Please enter income title.',
            'amount.required'=>'Please enter income amount.',
            'date.required'=>'Please enter income date.',
          ]);

            $id = $request['id'];
            $slug = $request['slug'];

            $update=Income::where('income_id', $id)->update([
            'income_title' => $request->title,
            'incate_id'=>$request['incate_id'],
            'income_amount' => $request->amount,
            'income_date' => $request->date,
            'income_editor' => Auth::user()->id,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        if($update){
          Session::flash('success','Successfully update Income information');
          return redirect('dashboard/income/view/'.$slug);
        }else{
          Session::flash('error','Opps! Operation failed.');
          return redirect('dashboard/income/edit/'.$slug);
        }
    }

    public function softdelete(){
        $id = $_POST['modal_id'];
        $softdelete=Income::where('income_status',1)->where('income_id',$id)->update([
            'income_status'=>0,
            'updated_at'=>Carbon::now()->toDateTimeString(),
          ]);

          if($softdelete){
            Session::flash('success','Successfully delete income information');
            return redirect('dashboard/income');
          }else{
            Session::flash('error','Opps!! operation failed');
            return redirect('dashboard/income');
          }
    }

    public function restore(){
        $id = $_POST['modal_id'];
        $restore=Income::where('income_status',0)->where('income_id',$id)->update([
            'income_status'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
          ]);

          if($restore){
            Session::flash('success','Successfully restore income information');
            return redirect('dashboard/recycle/income');
          }else{
            Session::flash('error','Opps!! operation failed');
            return redirect('dashboard/recycle/income');
          }
    }

    public function delete(){
        $id = $_POST['modal_id'];
        $delete=Income::where('income_status',0)->where('income_id',$id)->delete([]);

          if($delete){
            Session::flash('success','Successfully permanently delete income information');
            return redirect('dashboard/recycle/income');
          }else{
            Session::flash('error','Opps!! operation failed');
            return redirect('dashboard/recycle/income');
          }
    }
}
