<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ExpenseCategoryController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\IncomeCategoryController;
use App\Http\Controllers\Admin\IncomeController;
use App\Http\Controllers\Admin\RecycleController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SummaryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::get('dashboard', [AdminController::class, 'index']);

//for user route
Route::get('dashboard/user', [UserController::class, 'index']);
Route::get('dashboard/user/add', [UserController::class, 'add']);
Route::get('dashboard/user/edit/{id}', [UserController::class, 'edit']);
Route::get('dashboard/user/view/{id}', [UserController::class, 'view']);
Route::post('dashboard/user/submit', [UserController::class, 'insert']);
Route::post('dashboard/user/update', [UserController::class, 'update']);
Route::get('dashboard/user/softdelete', [UserController::class, 'softdelete']);
Route::post('dashboard/user/restore', [UserController::class, 'restore']);
Route::post('dashboard/user/delete', [UserController::class, 'delete']);

//for incomecategory route
Route::get('dashboard/incomeCategory', [IncomeCategoryController::class, 'index']);
Route::get('dashboard/incomeCategory/add', [IncomeCategoryController::class, 'add']);
Route::get('dashboard/incomeCategory/edit/{slug}', [IncomeCategoryController::class, 'edit']);
Route::get('dashboard/incomeCategory/view/{slug}', [IncomeCategoryController::class, 'view']);
Route::post('dashboard/incomeCategory/submit', [IncomeCategoryController::class, 'insert']);
Route::post('dashboard/incomeCategory/update', [IncomeCategoryController::class, 'update']);
Route::post('dashboard/incomeCategory/softdelete', [IncomeCategoryController::class, 'softdelete']);
Route::post('dashboard/incomeCategory/restore', [IncomeCategoryController::class, 'restore']);
Route::post('dashboard/incomeCategory/delete', [IncomeCategoryController::class, 'delete']);


//for income route
Route::get('dashboard/income', [IncomeController::class, 'index']);
Route::get('dashboard/income/add', [IncomeController::class, 'add']);
Route::get('dashboard/income/edit/{slug}', [IncomeController::class, 'edit']);
Route::get('dashboard/income/view/{slug}', [IncomeController::class, 'view']);
Route::post('dashboard/income/submit', [IncomeController::class, 'insert']);
Route::post('dashboard/income/update', [IncomeController::class, 'update']);
Route::post('dashboard/income/softdelete', [IncomeController::class, 'softdelete']);
Route::post('dashboard/income/restore', [IncomeController::class, 'restore']);
Route::post('dashboard/income/delete', [IncomeController::class, 'delete']);


//for expensecategory route
Route::get('dashboard/expenseCategory', [ExpenseCategoryController::class, 'index']);
Route::get('dashboard/expenseCategory/add', [ExpenseCategoryController::class, 'add']);
Route::get('dashboard/expenseCategory/edit/{slug}', [ExpenseCategoryController::class, 'edit']);
Route::get('dashboard/expenseCategory/view/{slug}', [ExpenseCategoryController::class, 'view']);
Route::post('dashboard/expenseCategory/submit', [ExpenseCategoryController::class, 'insert']);
Route::post('dashboard/expenseCategory/update', [ExpenseCategoryController::class, 'update']);
Route::post('dashboard/expenseCategory/softdelete', [ExpenseCategoryController::class, 'softdelete']);
Route::post('dashboard/expenseCategory/restore', [ExpenseCategoryController::class, 'restore']);
Route::post('dashboard/expenseCategory/delete', [ExpenseCategoryController::class, 'delete']);

//for expense route
Route::get('dashboard/expense', [ExpenseController::class, 'index']);
Route::get('dashboard/expense/add', [ExpenseController::class, 'add']);
Route::get('dashboard/expense/edit/{slug}', [ExpenseController::class, 'edit']);
Route::get('dashboard/expense/view/{slug}', [ExpenseController::class, 'view']);
Route::post('dashboard/expense/submit', [ExpenseController::class, 'insert']);
Route::post('dashboard/expense/update', [ExpenseController::class, 'update']);
Route::post('dashboard/expense/softdelete', [ExpenseController::class, 'softdelete']);
Route::post('dashboard/expense/restore', [ExpenseController::class, 'restore']);
Route::post('dashboard/expense/delete', [ExpenseController::class, 'delete']);

//summary route
Route::get('dashboard/summary', [SummaryController::class, 'index']);

//report route
Route::get('dashboard/report', [ReportController::class, 'index']);

//for recyclebin route
Route::get('dashboard/recycle', [RecycleController::class, 'index']);
Route::get('dashboard/recycle/user', [RecycleController::class, 'user']);
Route::get('dashboard/recycle/income', [RecycleController::class, 'income']);
Route::get('dashboard/recycle/income/category', [RecycleController::class, 'income_category']);

// recycle expense route
Route::get('dashboard/recycle/expense', [RecycleController::class, 'expense']);
Route::get('dashboard/recycle/expense/category', [RecycleController::class, 'expense_category']);

//role route
Route::get('dashboard/role', [RoleController::class, 'index']);
Route::get('dashboard/role/add', [RoleController::class, 'add']);
Route::get('dashboard/role/edit/{slug}', [RoleController::class, 'edit']);
Route::get('dashboard/role/view/{slug}', [RoleController::class, 'view']);
Route::post('dashboard/role/submit', [RoleController::class, 'insert']);
Route::post('dashboard/role/update', [RoleController::class, 'update']);
Route::post('dashboard/role/softdelete', [RoleController::class, 'softdelete']);
Route::post('dashboard/role/restore', [RoleController::class, 'restore']);
Route::post('dashboard/role/delete', [RoleController::class, 'delete']);

require __DIR__.'/auth.php';
