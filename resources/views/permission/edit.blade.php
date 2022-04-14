@extends('layouts.app')

@section('title')
    Edit {{ $permission->name }}
@endsection

@section('content')
    <div class="row">
        <div class="my-4 d-flex align-items-baseline">
            <div class="me-2">
                <span class="fs-4">Edit Permission</span>
                <span class="fs-4 ms-1 text-muted">|</span>
            </div>
            <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
                <x-bread-crumb>
                    <li class="breadcrumb-item"><a href="{{ route('permission.index') }}">Permission Lists</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Edit Permission
                    </li>
                </x-bread-crumb>
            </nav>
        </div>

        <div class="col-12">
            <div class="card emp-card shadow-sm">
                <div class="card-body">
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold">Edit Permission</h5>
                        <a href="{{ route('permission.index') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fa-solid fa-book me-1"></i>
                            <span>Lists</span>
                        </a>
                    </div>

                    <form action="{{ route('permission.update', $permission->id) }}" id="editForm" method="POST">
                        @csrf
                        @method('put')
                        <div class="mb-5">
                            <input type="text" class="form-control" name="name"
                                value="{{ old('name', $permission->name) }}" placeholder="Permission Name" required />
                        </div>

                        <div class="text-center mt-4 mb-3">
                            <a href="{{ route('permission.index') }}" class="btn btn-danger ">Cancel</a>
                            <button class="btn btn-primary px-5 ms-2">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\UpdatePermissionRequest', '#editForm') !!}
@endsection
