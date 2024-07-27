<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Income;
use Illuminate\Http\Request;

class SummaryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
      }

      public function index(){
        $allIncome=Income::where('income_status',1)->orderBy('income_id','DESC')->get();
        $allExpense=Expense::where('expense_status',1)->orderBy('expense_id','DESC')->get();
        return view('admin.summary.all',compact('allIncome','allExpense'));
      }
}
