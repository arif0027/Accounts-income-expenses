@extends('layouts.admin')
@section('content')
<div class="row">
  <div class="col-md-12 col-sm-12">
    <div class="card">
      <div class="card-header card_header">
        <div class="row">
          <div class="col-md-8 card_header_title">
              All Income Expense Summary
          </div>
          <div class="col-md-4 text-end card_header_btn">
            <a class="btn btn-sm btn-secondary" href="{{url('dashboard/income')}}">Income</a>
            <a class="btn btn-sm btn-secondary" href="{{url('dashboard/expense')}}">Expense</a>
          </div>
        </div>
      </div>
      <div class="card-body card_body">
        @if(Session::has('success'))
          <script type="text/javascript">
              swal({title: "Success!", text: "{{Session::get('success')}}", icon: "success", button: "OK", timer:5000,});
           </script>
        @endif
        @if(Session::has('error'))
            <script type="text/javascript">
                swal({title: "Opps!",text: "{{Session::get('error')}}", icon: "error", button: "OK", timer:5000,});
            </script>
        @endif

        <table id="example" class="table table-bordered table-striped table-hover custom_table" style="width:100%">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Debit</th>
                    <th>Credit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($allIncome as $income)
                <tr>
                    <td>{{$income->income_date}}</td>
                    <td>{{$income->income_title}}</td>
                    <td>{{$income->categoryInfo->incate_name}}</td>
                    <td>{{number_format($income->income_amount,2)}}</td>
                    <td></td>
                </tr>
                @endforeach
                @foreach($allExpense as $expense)
                <tr>
                    <td>{{$expense->expense_date}}</td>
                    <td>{{$expense->expense_title}}</td>
                    <td>{{$expense->categoryExp->expcate_name}}</td>
                    <td>---</td>
                    <td>{{number_format($expense->expense_amount,2)}}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="text-end">Total:</td>
                    <td>
                      @php
                        $totalIncome=App\Models\Income::where('income_status',1)->sum('income_amount');
                      @endphp
                      {{number_format($totalIncome,2)}}
                    </td>
                    <td>
                      @php
                        $totalExpense=App\Models\Expense::where('expense_status',1)->sum('expense_amount');
                      @endphp
                      {{number_format($totalExpense,2)}}
                    </td>
                  </tr>
            </tfoot>
        </table>
      </div>
      
      <div class="card-footer card_footer">
        <div class="btn-group" role="group" aria-label="">
					<button type="button" class="btn btn-secondary">Print</button>
					<button type="button" class="btn btn-primary">PDF</button>
					<button type="button" class="btn btn-secondary">Excel</button>
				</div>
      </div>
    </div>
  </div>
</div>

<!--softdelete modal code start -->
<div class="modal fade" id="softDeleteModal" tabindex="-1" role="dialog" aria-hidden="true">
  <form method="post" action="{{url('dashboard/income/softdelete')}}">
    @csrf
  	<div class="modal-dialog" role="document">
  		<div class="modal-content">
  			<div class="modal-header">
  				<h5 class="modal-title">Confirm Message</h5>
  			</div>
  			<div class="modal-body m-1 modal_body">
             Are you sure you want to delete?
            <input type="hidden" name="modal_id" id="modal_id"/>
  			</div>
  			<div class="modal-footer">
          <button type="submit" class="btn btn-success">Confirm</button>
  				<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
  			</div>
  		</div>
  	</div>
  </form>
</div>
@endsection
