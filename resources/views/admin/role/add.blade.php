@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12 ">
        <form method="post" action="{{URL('dashboard/role/submit')}}" enctype="multipart/form-data">
          @csrf
            <div class="card mb-3">
              <div class="card-header">
                <div class="row">
                    <div class="col-md-8 card_title_part">
                        <i class="fab fa-gg-circle"></i>Add Role Information
                    </div>
                    <div class="col-md-4 card_button_part">
                        <a href="{{url('dashboard/role')}}" class="btn btn-sm btn-dark"><i class="fas fa-th"></i>All Role</a>
                    </div>
                </div>
              </div>
              <div class="card-body">
                  <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                      @if(Session::has('success'))
                        <div class="alert alert-success alertsuccess" role="alert">
                           <strong>Success!</strong> {{Session::get('success')}}
                        </div>
                      @endif
                      @if(Session::has('error'))
                        <div class="alert alert-warning alertsuccess" role="alert">
                           <strong>Success!</strong> {{Session::get('error')}}
                        </div>
                      @endif
                    </div>
                    <div class="col-md-2"></div>
                  </div>
                  <div class="row mb-3 {{ $errors->has('name') ? ' has-error' : '' }}">
                    <label class="col-sm-3 col-form-label col_form_label">Role Name<span class="req_star">*</span>:</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control form_control" id="" name="name" value="{{old('name')}}">
                      @if ($errors->has('name'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('name') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label col_form_label">Remarks:</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control form_control" id="" name="remarks" value="{{old('remakrs')}}">
                    </div>
                  </div>

              </div>
              <div class="card-footer text-center">
                <button type="submit" class="btn btn-sm btn-dark">UPLOAD</button>
              </div>
            </div>
        </form>
    </div>
</div>
@endsection
