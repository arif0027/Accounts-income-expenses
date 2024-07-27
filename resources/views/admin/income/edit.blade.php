@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12 ">
        <form method="post" action="{{url('dashboard/income/update')}}">
            @csrf
            <div class="card mb-3">
              <div class="card-header">
                <div class="row">
                    <div class="col-md-8 card_title_part">
                        <i class="fab fa-gg-circle"></i>Update Income Information
                    </div>
                    <div class="col-md-4 card_button_part">
                        <a href="{{ url('dashboard/income') }}" class="btn btn-sm btn-dark"><i class="fas fa-th"></i>All income</a>
                    </div>
                </div>
              </div>
              <div class="card-body">
                    @if(Session::has('success'))
                    <script>
                        swal({title: "Success", text: "{{ Session::get('success') }}", icon: "success", button: "ok", timer:5000})
                    </script>
                    @endif
                    @if(Session::has('error'))
                        <script>
                            swal({title: "Error", text: "{{ Session::get('error') }}", icon: "warning", button: "ok", timer:5000})
                        </script>
                    @endif
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label col_form_label">Income Title<span class="req_star">*</span>:</label>
                    <div class="col-sm-7">
                        <input type="hidden" name="id" value="{{$data->income_id}}"/>
                        <input type="hidden" name="slug" value="{{$data->income_slug}}"/>
                      <input type="text" class="form-control form_control" id="" name="title" value="{{$data->income_title}}">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label col_form_label">Income Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control form_control" id="" name="amount" value="{{$data->income_amount}}">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label col_form_label">Income Date</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control form_control" id="date" name="date" value="{{$data->income_date}}">
                    </div>
                  </div>
              </div>
              <div class="card-footer text-center">
                <button type="submit" class="btn btn-sm btn-dark">UPDATE</button>
              </div>
            </div>
        </form>
    </div>
</div>
@endsection
