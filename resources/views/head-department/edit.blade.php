@extends('layouts.app')

@section('title')
    Edit {{ $hod->title }}
@endsection

@section('content')
    <div class="row">
        <div class="my-4 d-flex align-items-baseline">
            <div class="me-2">
                <span class="fs-4">Edit Head Department</span>
                <span class="fs-4 ms-1 text-muted">|</span>
            </div>
            <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
                <x-bread-crumb>
                    <li class="breadcrumb-item"><a href="{{ route('head-of-department.index') }}">Head Of Departments</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Edit
                    </li>
                </x-bread-crumb>
            </nav>
        </div>

        <div class="col-12">
            <div class="card emp-card shadow-sm">
                <div class="card-body">
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold">Add Department</h5>
                        <button class="btn btn-outline-primary btn-sm">
                            <i class="fa-solid fa-book me-1"></i>
                            <span>Lists</span>
                        </button>
                    </div>

                    <form action="{{ route('head-of-department.update', $hod->id) }}" id="editForm" method="POST">
                        @csrf
                        @method('put')
                        <div class="mb-5">
                            <input type="text" class="form-control" name="title" value="{{ old('title', $hod->title) }}"
                                placeholder="Head Department Name" required />
                        </div>

                        <div class="text-center mt-4 mb-3">
                            <a href="{{ route('head-of-department.index') }}" class="btn btn-danger ">Cancel</a>
                            <button class="btn btn-primary px-5 ms-2">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\UpdateHeadOfDepRequest', '#editForm') !!}
    <script>
        $(".st-date").flatpickr({
            dateFormat: "d.m.Y",
        });
    </script>
@endsection
