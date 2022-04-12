@extends('layouts.app')

@section('name')
    Head Of Department
@endsection

@section('content')
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card shadow-sm dt-card">
                <div class="card-body">
                    <table class="table table-hover table-striped w-100" id="dataTable">
                        <thead>
                            <th class="">Name</th>
                            <th class="no-sort">Control</th>
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
            $('#dataTable').DataTable({
                ajax: '{{ route('head-dep.ssd') }}',
                columns: [{
                        data: 'title',
                        name: 'title'
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
            });
        })
    </script>
@endsection
