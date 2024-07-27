@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
                <div class="col-md-8 card_title_part">
                    <i class="fab fa-gg-circle"></i>All Income Category Information
                </div>
                <div class="col-md-4 card_button_part">
                    <a href="{{ url('dashboard/incomeCategory/add') }}" class="btn btn-sm btn-dark"><i class="fas fa-plus-circle"></i>Add IncomeCategory</a>
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
            <table class="table table-bordered table-striped table-hover custom_table">
              <thead class="table-dark">
                <tr>
                  <th>Name</th>
                  <th>Remarks</th>
                  <th>Manage</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($all as $data)
                    <tr>
                        <td>{{ $data->incate_name }}</td>
                        <td>{{ $data->incate_remarks }}</td>
                        <td>
                            <div class="btn-group btn_group_manage" role="group">
                            <button type="button" class="btn btn-sm btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Manage</button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ url('dashboard/incomeCategory/view/'.$data->incate_slug) }}">View</a></li>
                                <li><a class="dropdown-item" href="{{ url('dashboard/incomeCategory/edit/'.$data->incate_slug) }}">Edit</a></li>
                                <li><a class="dropdown-item" href="#" id="softDelete" data-bs-toggle="modal" data-bs-target="#softDeleteModal" data-id="{{ $data->incate_id }}">Delete</a></li>
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
              <button type="button" class="btn btn-sm btn-secondary">PDF</button>
              <button type="button" class="btn btn-sm btn-dark">Excel</button>
            </div>
          </div>
        </div>
    </div>
</div>

{{-- delete modal code --}}
<div class="modal fade" id="softDeleteModal" tabindex="-1" aria-labelledby="softDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ url('dashboard/incomeCategory/softdelete') }}" method="POST">
            @csrf
            <div class="modal-content modal_content">
                <div class="modal-header modal_header">
                  <h5 class="modal-title modal_title" id="softDeleteModalLabel"><i class="fab fa-gg-circle"></i> Confirm Message</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modal_body">
                  Are you want to sure delete data?
                  <input type="hidden" name="modal_id" id="modal_id"/>
                </div>
                <div class="modal-footer modal_footer">
                  <button type="submit" class="btn btn-sm btn-success">Confirm</button>
                  <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
  </div>
@endsection

