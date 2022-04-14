@extends('layouts.app')

@section('name')
    Departments
@endsection

@section('content')
    <div class="row">
        <div class="my-4 d-flex align-items-baseline">
            <div class="me-2">
                <span class="fs-4">All Departments</span>
                <span class="fs-4 ms-1 text-muted">|</span>
            </div>
            <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
                <x-bread-crumb>
                    <li class="breadcrumb-item active" aria-current="page">
                        Departments
                    </li>
                </x-bread-crumb>
            </nav>
        </div>

        <div class="mb-3">
            <a href="{{ route('department.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-circle-plus me-1"></i>
                Add
            </a>
        </div>

        <div class="col-12">
            <div class="card shadow-sm dt-card">
                <div class="card-body">
                    <table class="table table-hover table-striped w-100 py-3 " id="dataTable">
                        <thead>
                            <th class="no-sort"></th>
                            <th class="">Department</th>
                            <th class="">Head.Dept</th>
                            <th class="">Phone</th>
                            <th class="">Email</th>
                            <th class="">Employees</th>
                            <th class="no-sort">Control</th>
                            <th class="">Start Date</th>
                            <th class="text-center hidden">Updated_at</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            var table = $('#dataTable').DataTable({
                ajax: '{{ route('department.ssd') }}',
                columns: [{
                        data: 'plus-icon',
                        name: 'plus-icon',
                        class: 'text-center'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'head_dep',
                        name: 'head_dep',
                    },
                    {
                        data: 'phone',
                        name: 'phone',
                    },
                    {
                        data: 'email',
                        name: 'email',
                    },
                    {
                        data: 'total_employees',
                        name: 'total_employees',
                    },
                    {
                        data: 'action',
                        name: 'action',
                    },
                    {
                        data: 'start_date',
                        name: 'start_date',
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at',
                    },
                ],
                order: [
                    [3, "desc"]
                ],
            });

            $(document).on('click', '.del-btn', function(e, id) {
                e.preventDefault();

                var id = $(this).data("id");

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire("Deleted!", "Your file has been deleted.", "success");
                        $.ajax({
                            method: "DELETE",
                            url: `/department/${id}`,
                        }).done(function(res) {
                            table.ajax.reload();
                        })
                    }
                });
            })
        })
    </script>
@endsection
