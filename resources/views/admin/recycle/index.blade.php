@extends('layouts.admin')
@section('content')
<div class="row">
  <a href="{{url('dashboard/recycle/user')}}">
    <div class="col-12 col-sm-6 col-xxl-3 d-flex">
      <div class="card flex-fill">
        <div class="card-body py-4">
          @php
            $totalUser=App\Models\User::where('status',0)->count();
          @endphp
          <div class="d-flex align-items-start">
            <div class="flex-grow-1">
              <p class="mb-2">Users</p>
              <h3 class="mb-2">
                @if($totalUser < 10)
                  0{{$totalUser}}
                @else
                  {{$totalUser}}
                @endif
              </h3>
            </div>
            <div class="d-inline-block ms-3">
              <div class="stat">
                <i class="align-middle text-info" data-feather="users"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </a>
</div>
@endsection
