@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')
@section('title', 'List Administrators')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/datatable/datatables.min.css') }}" />
@endpush

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-warning fw-light">Administrators </span>/ List Admin</h4>

<!-- DataTable with Buttons -->
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">List Admin</h4>
            <a href="" class="btn btn-primary"><i class="fa fa-plus"></i> &nbsp;Create</a>
            {{-- /Create Button for Add New Admin --}}
        </div>
    </div>
    <div class="table" style="padding: 0 30px 30px 30px;">
        <table class="table table-hover table-responsive display" id="myTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Group</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@push('scripts')
<script src="{{ asset('assets/datatable/datatables.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "autoWidth": false,
            ajax: "{{ route('backend.setup.admin.list-admins') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex',width:'10px', orderable: false, searchable: false},
                {data: 'username', name: 'username'},
                {data: 'fullname', name: 'fullname'},
                {data: 'group.name', name: 'group.name'}, // Tambahkan baris ini
                {data: 'email', name: 'email'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>
@endpush
@endsection
