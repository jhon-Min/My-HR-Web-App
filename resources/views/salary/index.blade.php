@extends('layouts.app')

@section('title')
    Salary Lists
@endsection

@section('content')
    <div class="row">
        <div class="my-4 d-flex align-items-baseline">
            <div class="me-2">
                <span class="fs-4">All Salaries</span>
                <span class="fs-4 ms-1 text-muted">|</span>
            </div>
            <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
                <x-bread-crumb>
                    <li class="breadcrumb-item active" aria-current="page">
                        Salary Lists
                    </li>
                </x-bread-crumb>
            </nav>
        </div>

        <div class="mb-3">
            @can('view_salary')
                <x-create-item link="{{ route('salary.create') }}">Add</x-create-item>
            @endcan
        </div>

        <div class="col-12">
            <div class="card shadow-sm dt-card">
                <div class="card-body">
                    <table class="table table-hover table-striped w-100 py-3" id="dataTable">
                        <thead>
                            <th class="no-sort"></th>
                            <th>Employee</th>
                            <th>Month</th>
                            <th>Year</th>
                            <th>Amount (MMK)</th>
                            <th>Contorl</th>
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
                ajax: '{{ route('salary.ssd') }}',
                columns: [{
                        data: 'plus-icon',
                        name: 'plus-icon',
                    },
                    {
                        data: 'employee',
                        name: 'employee',
                    },
                    {
                        data: 'month',
                        name: 'month',
                    },
                    {
                        data: 'year',
                        name: 'year',
                    },
                    {
                        data: 'amount',
                        name: 'amount',
                    },
                    {
                        data: 'action',
                        name: 'action',
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at',
                    },
                ],
                order: [
                    [6, "desc"]
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
                            url: `/salary/${id}`,
                        }).done(function(res) {
                            table.ajax.reload();
                        })
                    }
                });
            })
        })
    </script>
@endsection
