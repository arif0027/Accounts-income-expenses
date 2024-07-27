<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ExpenseController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $all =Expense::where('expense_status',1)->orderBy('expense_id', 'DESC')->get();
        return view('admin.expense.all',compact('all'));
    }

    public function add(){
        $categories = ExpenseCategory::all();
        return view('admin.expense.add',compact('categories'));
    }

    public function edit($slug){
        $data=Expense::where('expense_status',1)->where('expense_slug',$slug)->firstOrFail();
        return view('admin.expense.edit',compact('data'));
    }

    public function view($slug){
        $data=Expense::where('expense_status',1)->where('expense_slug',$slug)->firstOrFail();
        return view('admin.expense.view',compact('data'));
    }
    public function insert(Request $request){
        $this->validate($request,[
            'title'=>'required',
            'amount'=>'required',
            'date'=>'required',
          ],[
            'title.required'=>'Please enter expense title.',
            'amount.required'=>'Please enter expense amount.',
            'date.required'=>'Please enter expense date.',
          ]);

          $slug='B'.uniqid();
          $creator=Auth::user()->id;

          $insert=Expense::insertGetId([
            'expense_title'=>$request['title'],
            'expcate_id'=>$request['expcate_id'],
            'expense_amount'=>$request['amount'],
            'expense_date'=>$request['date'],
            'expense_creator'=>$creator,
            'expense_slug'=>$slug,
            'created_at'=>Carbon::now()->toDateTimeString(),
          ]);

          if($insert){
            Session::flash('success','Successfully upload expense information');
            return redirect('dashboard/expense/add');
          }else{
            Session::flash('error','Opps!! operation failed');
            return redirect('dashboard/expense/add');
          }
    }

    public function update(Request $request){
        $this->validate($request,[
            'title'=>'required',
            'amount'=>'required',
            'date'=>'required',
          ],[
            'title.required'=>'Please enter expense title.',
            'amount.required'=>'Please enter expense amount.',
            'date.required'=>'Please enter expense date.',
          ]);

            $id = $request['id'];
            $slug = $request['slug'];

            $update=Expense::where('expense_id', $id)->update([
            'expense_title' => $request->title,
            'expcate_id'=>$request['expcate_id'],
            'expense_amount' => $request->amount,
            'expense_date' => $request->date,
            'expense_editor' => Auth::user()->id,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        if($update){
          Session::flash('success','Successfully update expense information');
          return redirect('dashboard/expense/view/'.$slug);
        }else{
          Session::flash('error','Opps! Operation failed.');
          return redirect('dashboard/expense/edit/'.$slug);
        }
    }

    public function softdelete(){
        $id = $_POST['modal_id'];
        $softdelete=Expense::where('expense_status',1)->where('expense_id',$id)->update([
            'expense_status'=>0,
            'updated_at'=>Carbon::now()->toDateTimeString(),
          ]);

          if($softdelete){
            Session::flash('success','Successfully delete expense information');
            return redirect('dashboard/expense');
          }else{
            Session::flash('error','Opps!! operation failed');
            return redirect('dashboard/expense');
          }
    }

    public function restore(){
        $id = $_POST['modal_id'];
        $restore=Expense::where('expense_status',0)->where('expense_id',$id)->update([
            'expense_status'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
          ]);

          if($restore){
            Session::flash('success','Successfully restore expense information');
            return redirect('dashboard/recycle/expense');
          }else{
            Session::flash('error','Opps!! operation failed');
            return redirect('dashboard/recycle/expense');
          }
    }

    public function delete(){
        $id = $_POST['modal_id'];
        $delete=Expense::where('expense_status',0)->where('expense_id',$id)->delete([]);

          if($delete){
            Session::flash('success','Successfully permanently delete expense information');
            return redirect('dashboard/recycle/expense');
          }else{
            Session::flash('error','Opps!! operation failed');
            return redirect('dashboard/recycle/expense');
          }
    }
}
