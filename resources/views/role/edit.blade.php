@extends('layouts.app')

@section('title')
    Edit {{ $role->name }}
@endsection

@section('content')
    <div class="row">
        <div class="my-4 d-flex align-items-baseline">
            <div class="me-2">
                <span class="fs-4">Edit Role</span>
                <span class="fs-4 ms-1 text-muted">|</span>
            </div>
            <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
                <x-bread-crumb>
                    <li class="breadcrumb-item"><a href="{{ route('role.index') }}">Role Lists</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Edit Role
                    </li>
                </x-bread-crumb>
            </nav>
        </div>

        <div class="col-12">
            <div class="card emp-card shadow-sm">
                <div class="card-body">
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold">Edit Role</h5>
                        <a href="{{ route('role.index') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fa-solid fa-book me-1"></i>
                            <span>Lists</span>
                        </a>
                    </div>

                    <form action="{{ route('role.update', $role->id) }}" id="editForm" method="POST">
                        @csrf
                        @method('put')
                        <div class="mb-5">
                            <input type="text" class="form-control" name="name" value="{{ old('name', $role->name) }}"
                                placeholder="Role Name" required />
                        </div>

                        <div class="col-12">
                            <p class="mb-2 text-semi small font-weight-bolder">Permissions</p>
                            <div class="row">
                                @foreach ($permissions as $permission)
                                    <div class="col-6 col-md-3 col-lg-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="permissions[]"
                                                value="{{ $permission->id }}" id="defaultCheck{{ $permission->id }}"
                                                @if (in_array($permission->id, $old_permissions)) checked @endif>
                                            <label class="form-check-label" for="defaultCheck{{ $permission->id }}">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="text-center mt-4 mb-3">
                            <a href="{{ route('role.index') }}" class="btn btn-danger ">Cancel</a>
                            <button class="btn btn-primary px-5 ms-2">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\UpdateRoleRequest', '#editForm') !!}
@endsection
