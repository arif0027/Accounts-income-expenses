@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12 ">
        <form method="post" action="{{url('dashboard/user/submit')}}" enctype="multipart/form-data">
          @csrf
            <div class="card mb-3">
              <div class="card-header">
                <div class="row">
                    <div class="col-md-8 card_title_part">
                        <i class="fab fa-gg-circle"></i>User Registration
                    </div>
                    <div class="col-md-4 card_button_part">
                        <a href="{{url('dashboard/user')}}" class="btn btn-sm btn-dark"><i class="fas fa-th"></i>All User</a>
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
                         <strong>Error!</strong> {{Session::get('error')}}
                      </div>
                    @endif
                  </div>
                  <div class="col-md-2"></div>
                </div>
                  <div class="row mb-3 {{ $errors->has('name') ? ' has-error' : '' }}">
                    <label class="col-sm-3 col-form-label col_form_label">Name<span class="req_star">*</span>:</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control form_control" id="" name="name" value="{{old('name')}}">
                      @if ($errors->has('name'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('name') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>
                  <div class="row mb-3 ">
                    <label class="col-sm-3 col-form-label col_form_label">Phone:</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control form_control" id="" name="phone" value="{{old('phone')}}">

                    </div>
                  </div>
                  <div class="row mb-3 {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="col-sm-3 col-form-label col_form_label">Email:<span class="req_star">*</span>:</label>
                    <div class="col-sm-7">
                      <input type="email" class="form-control form_control" id="" name="email" value="{{old('email')}}">
                      @if ($errors->has('email'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>
                  <div class="row mb-3 {{ $errors->has('username') ? ' has-error' : '' }}">
                    <label class="col-sm-3 col-form-label col_form_label">Username<span class="req_star">*</span>:</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control form_control" id="" name="username" value="{{old('username')}}">
                      @if ($errors->has('username'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('username') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>
                  <div class="row mb-3 {{ $errors->has('password') ? ' has-error' : '' }}">
                    <label class="col-sm-3 col-form-label col_form_label">Password<span class="req_star">*</span>:</label>
                    <div class="col-sm-7">
                      <input type="password" class="form-control form_control" id="" name="password">
                      @if ($errors->has('password'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label col_form_label">Confirm-Password<span class="req_star">*</span>:</label>
                    <div class="col-sm-7">
                      <input type="password" class="form-control form_control" id="" name="repassword">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label col_form_label">User Role<span class="req_star">*</span>:</label>
                    <div class="col-sm-4">
                      @php
                        $allRole=App\Models\Role::where('role_status',1)->orderBy('role_id','ASC')->get();
                      @endphp
                      <select class="form-control form_control" id="" name="role">
                        <option value="">Select Role</option>
                        @foreach($allRole as $urole)
                        <option value="{{$urole->role_id}}">{{$urole->role_name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label col_form_label">Photo:</label>
                    <div class="col-sm-4">
                      <input type="file" class="form-control form_control" id="" name="pic">
                    </div>
                  </div>
              </div>
              <div class="card-footer text-center">
                <button type="submit" class="btn btn-sm btn-dark">REGISTRATION</button>
              </div>
            </div>
        </form>
    </div>
</div>
@endsection
