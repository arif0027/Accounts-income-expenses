@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
                <div class="col-md-8 card_title_part">
                    <i class="fab fa-gg-circle"></i>All Role Information
                </div>
                <div class="col-md-4 card_button_part">
                    <a href="{{url('dashboard/role/add')}}" class="btn btn-sm btn-dark"><i class="fas fa-plus-circle"></i>Add Role</a>
                </div>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-bordered table-striped table-hover custom_table">
              <thead class="table-dark">
                <tr>
                  <th>Role Name</th>
                  <th>Remarks</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach($all as $data)
                <tr>
                  <td>{{$data->role_name}}</td>
                  <td>{{$data->role_remarks}}</td>
                  <td>
                      <div class="btn-group btn_group_manage" role="group">
                        <button type="button" class="btn btn-sm btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Manage</button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="{{url('dashboard/role/view/'.$data->role_slug)}}">View</a></li>
                          <li><a class="dropdown-item" href="{{url('dashboard/role/edit/'.$data->role_slug)}}">Edit</a></li>
                          <li><a href="#" id="delete" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{$data->role_id}}">Delete</a></li>
                        </ul>
                      </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="card-footer">
            <div class="btn-group" role="group" aria-label="Button group">
              <button type="button" class="btn btn-sm btn-dark">Print</button>
              <a href="{{url('dashboard/role/pdf')}}" class="btn btn-sm btn-secondary">PDF</a>
              <a href="{{url('dashboard/role/excel')}}"  class="btn btn-sm btn-dark">Excel</a>
            </div>
          </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post" action="{{url('dashboard/role/softdelete')}}">
      @csrf
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Confermation message</h1>
      </div>
      <div class="modal-body modal_card">
        <input type="hidden" id="modal_id" name="modal_id"/>
        Do you want to delete?
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Delete</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

      </div>
    </div>
    <form/>
  </div>
</div>
</div>
@endsection
