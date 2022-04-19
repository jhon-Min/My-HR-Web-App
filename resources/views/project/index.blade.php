@extends('layouts.app')

@section('title')
    Project Lists
@endsection

@section('content')
    <div class="row">
        <div class="my-4 d-flex align-items-baseline">
            <div class="me-2">
                <span class="fs-4">Projects</span>
                <span class="fs-4 ms-1 text-muted">|</span>
            </div>
            <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
                <x-bread-crumb>
                    <li class="breadcrumb-item active" aria-current="page">
                        Project Lists
                    </li>
                </x-bread-crumb>
            </nav>
        </div>

        <div class="mb-3">
            <x-create-item link="{{ route('project.create') }}">Add</x-create-item>
        </div>

        <div class="col-12">
            <div class="card shadow-sm dt-card">
                <div class="card-body">
                    <table class="table table-hover table-striped w-100 att-table" id="dataTable">
                        <thead>
                            <th class="no-sort"></th>
                            <th>Project Name</th>
                            <th>Leaders</th>
                            <th>Members</th>
                            <th>Start Date</th>
                            <th>Deadline</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th class="no-sort">Control</th>
                            <th class="hidden">Updated_at</th>
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
                ajax: '{{ route('project.ssd') }}',
                columns: [{
                        data: 'plus-icon',
                        name: 'plus-icon',
                    },
                    {
                        data: 'title',
                        name: 'title',
                    },
                    {
                        data: 'leaders',
                        name: 'leaders',
                    },
                    {
                        data: 'members',
                        name: 'members',
                    },
                    {
                        data: 'start_date',
                        name: 'start_date',
                    },
                    {
                        data: 'deadline',
                        name: 'deadline',
                    },
                    {
                        data: 'priority',
                        name: 'priority',
                    },
                    {
                        data: 'status',
                        name: 'status',
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
                    [9, "desc"]
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
                            url: `/project/${id}`,
                        }).done(function(res) {
                            table.ajax.reload();
                        })
                    }
                });
            })
        })
    </script>
@endsection
