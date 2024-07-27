@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12 ">
        <form method="post" action="{{url('dashboard/user/update')}}" enctype="multipart/form-data">
          @csrf
            <div class="card mb-3">
              <div class="card-header">
                <div class="row">
                    <div class="col-md-8 card_title_part">
                        <i class="fab fa-gg-circle"></i>Update User Information
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
                         <strong>Success!</strong> {{Session::get('error')}}
                      </div>
                    @endif
                  </div>
                  <div class="col-md-2"></div>
                </div>
                  <div class="row mb-3 {{ $errors->has('name') ? ' has-error' : '' }}">
                    <label class="col-sm-3 col-form-label col_form_label">Name<span class="req_star">*</span>:</label>
                    <div class="col-sm-7">
                      <input type="hidden" name="id" value="{{$data->id}}"/>
                      <input type="text" class="form-control form_control" id="" name="name" value="{{$data->name}}">
                      @if ($errors->has('name'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('name') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label col_form_label">Phone:</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control form_control" id="" name="phone" value="{{$data->phone}}">
                    </div>
                  </div>
                  <div class="row mb-3 {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="col-sm-3 col-form-label col_form_label">Email<span class="req_star">*</span>:</label>
                    <div class="col-sm-7">
                      <input type="email" class="form-control form_control" id="" name="email" value="{{$data->email}}">
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
                      <input type="text" class="form-control form_control" id="" name="username" value="{{$data->username}}">
                      @if ($errors->has('username'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('username') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label col_form_label">User Role<span class="req_star">*</span>:</label>
                    <div class="col-sm-4">
                      @php
                        $allRole=App\Models\Role::where('role_status',1)->orderBy('role_id','ASC')->get();
                      @endphp
                      <select class="form-control form_control" id="" name="role">
                        <option>Select Role</option>
                        @foreach($allRole as $urole)
                        <option value="{{$urole->role_id}}" @if($urole->role_id==$data->role_id) selected  @endif>{{$urole->role_name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label col_form_label">Photo:</label>
                    <div class="col-sm-4">
                      <input type="file" class="form-control form_control" id="" name="pic">
                    </div>
                    <div class="col-md-2">
                      @if($data->photo!='')
                      <img height="100" src="{{asset('uploads/user/'.$data->photo)}}" alt="">
                      @else
                      <img height="100" src="{{asset('contents/admin')}}/images/avatar.png" alt="">
                      @endif
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
