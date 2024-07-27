@extends('layouts.admin')
@section('content')
@php
  $all=App\Models\User::where('status',0)->orderBy('id','DESC')->get();
@endphp
<div class="row">
  <div class="col-md-12 col-sm-12">
    <div class="card">
      <div class="card-header card_header">
        <div class="row">
          <div class="col-md-8 card_header_title">
              All Recycle User
          </div>
          <div class="col-md-4 text-end card_header_btn">
            <a class="btn btn-sm btn-secondary" href="{{url('dashboard/recycle')}}">Recycle</a>
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
        <table class="table table-bordered table-striped table-hover custom_table">
          <thead class="table-dark">
            <tr>
              <th>Name</th>
              <th>Phone</th>
              <th>Email</th>
              <th>Role</th>
              <th>Photo</th>
              <th>Manage</th>
            </tr>
          </thead>
          <tbody>
            @foreach($all as $data)
            <tr>
              <td>{{$data->name}}</td>
              <td>{{$data->phone}}</td>
              <td>{{$data->email}}</td>
              <td>....</td>
              <td>
                @if($data->photo!='')
                  <img height="40" src="{{asset('uploads/'.$data->photo)}}" alt=""/>
                @else
                  <img height="40" src="{{asset('uploads/avatar.png')}}" alt=""/>
                @endif
              </td>
              <td>
                <a href="#" id="restore" title="Restore" data-bs-toggle="modal" data-bs-target="#restoreModal" data-id="{{$data->id}}"><span class="fas fa-recycle recycle"></span></a>
                <a href="#" id="delete" title="Delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{$data->id}}"><span class="fas fa-trash-alt trash"></span></a>
              </td>
            </tr>
            @endforeach
          </tbody>
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
<!--restore modal code start -->
<div class="modal fade" id="restoreModal" tabindex="-1" role="dialog" aria-hidden="true">
  <form method="post" action="{{url('dashboard/user/restore')}}">
    @csrf
  	<div class="modal-dialog" role="document">
  		<div class="modal-content">
  			<div class="modal-header">
  				<h5 class="modal-title">Confirm Message</h5>
  			</div>
  			<div class="modal-body m-1 modal_body">
             Are you sure you want to restore data?
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
<!--delete modal code start -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
  <form method="post" action="{{url('dashboard/user/delete')}}">
    @csrf
  	<div class="modal-dialog" role="document">
  		<div class="modal-content">
  			<div class="modal-header">
  				<h5 class="modal-title">Confirm Message</h5>
  			</div>
  			<div class="modal-body m-1 modal_body">
             Are you sure you want to permanently delete?
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
