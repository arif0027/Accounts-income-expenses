@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
                <div class="col-md-8 card_title_part">
                    <i class="fab fa-gg-circle"></i>All Income Information
                </div>
                <div class="col-md-4 card_button_part">
                    <a href="{{ url('dashboard/income/add') }}" class="btn btn-sm btn-dark"><i class="fas fa-plus-circle"></i>Add Income</a>
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

            <table id="example" class="table table-bordered table-striped table-hover custom_table" style="width:100%">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all as $data)
                        <tr>
                            <td>{{ $data->income_title }}</td>
                            <td>{{ $data->categoryInfo->incate_name }}</td>
                            <td>{{ $data->income_amount }}</td>
                            <td>{{ $data->income_date }}</td>
                            <td>
                                <div class="btn-group btn_group_manage" role="group">
                                <button type="button" class="btn btn-sm btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Manage</button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ url('dashboard/income/view/'.$data->income_slug) }}">View</a></li>
                                    <li><a class="dropdown-item" href="{{ url('dashboard/income/edit/'.$data->income_slug) }}">Edit</a></li>
                                    <li><a class="dropdown-item" href="#" id="softDelete" data-bs-toggle="modal" data-bs-target="#softDeleteModal" data-id="{{ $data->income_id }}">Delete</a></li>
                                </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Manage</th>
                    </tr>
                </tfoot>
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
        <form action="{{ url('dashboard/income/softdelete') }}" method="POST">
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

