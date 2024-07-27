@extends('layouts.admin')
@section('content')
@php
    $all = App\Models\ExpenseCategory::where('expcate_status',0)->orderBy('expcate_id', 'DESC')->get();
@endphp

<div class="row">
    <div class="col-md-12">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
                <div class="col-md-8 card_title_part">
                    <i class="fab fa-gg-circle"></i>Recycle Expense Category Information
                </div>
                <div class="col-md-4 card_button_part">
                    <a href="{{ url('dashboard/recycle') }}" class="btn btn-sm btn-dark"><i class="fas fa-plus-circle"></i>Recycle Bin</a>
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
                        <td>{{ $data->expcate_name }}</td>
                        <td>{{ $data->expcate_remarks }}</td>
                        <td>
                            <a href="#" id="restore" data-bs-toggle="modal" data-bs-target="#restoreModal" data-id="{{ $data->expcate_id }}"><i class="fas fa-solid fa-recycle fs-5 text-success fw-bold mx-1"></i></a>
                            <a href="#" id="delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $data->expcate_id }}"><i class="fas fa-trash fs-5 text-danger fw-bold"></i></a>
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

{{-- restore modal code --}}
<div class="modal fade" id="restoreModal" tabindex="-1" aria-labelledby="restoreModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ url('dashboard/expenseCategory/restore') }}" method="POST">
            @csrf
            <div class="modal-content modal_content">
                <div class="modal-header modal_header">
                  <h5 class="modal-title modal_title" id="restoreModalLabel"><i class="fab fa-gg-circle"></i> Confirm Message</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modal_body">
                  Are you want to sure restore data?
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


  {{-- delete modal code --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ url('dashboard/expenseCategory/delete') }}" method="POST">
            @csrf
            <div class="modal-content modal_content">
                <div class="modal-header modal_header">
                  <h5 class="modal-title modal_title" id="deleteModalLabel"><i class="fab fa-gg-circle"></i> Confirm Message</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modal_body">
                  Are you want to sure parmanently delete data?
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

