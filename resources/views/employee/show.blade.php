@extends('layouts.app')

@section('title')
    Employee Detail
@endsection


@section('content')
    <div class="row">
        <div class="my-4 d-flex align-items-baseline">
            <div class="me-2">
                <span class="fs-4">Employee</span>
                <span class="fs-4 ms-1 text-muted">|</span>
            </div>
            <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
                <x-bread-crumb>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $employee->name }}'s detail
                    </li>
                </x-bread-crumb>
            </nav>
        </div>

        <div class="col-12 col-md-5 col-lg-4 mb-3 mb-md-0">
            <div class="card profile-card shadow">
                <div class="text-center">
                    <div class="bg-dark py-5">
                    </div>

                    <div class="d-flex justify-content-center">
                        <div class="profile-img shadow-sm" style="margin-top: -50px">
                            <img src="{{ asset($employee->profile_img_path()) }}" alt=" User Profile">
                        </div>
                    </div>

                </div>
                <div class="card-body text-center mt-2">
                    <h5 class="fw-bold text-secondary">{{ $employee->name }}</h5>
                    <p class="small mb-1">{{ $employee->address }}</p>
                    <p class="small mb-4">
                        <i class="fa-solid fa-square-phone me-1 text-success"></i>
                        {{ $employee->phone }}
                    </p>

                </div>
            </div>
        </div>

        <div class="col-12 col-md-7 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h6 class="fw-bold mb-4">Details</h6>
                    <div class="row">
                        <div class="col-6 col-md-3">
                            <p class="mb-1 small text-secondary">
                                <i class="fa-solid fa-id-card"></i>
                                Employee ID
                            </p>
                            <p class="">{{ $employee->employee_id }}</p>
                        </div>

                        <div class="col-6 col-md-3">
                            <p class="mb-1 small text-secondary">
                                <i class="fa-solid fa-envelope"></i>
                                Email
                            </p>
                            <p class="">{{ $employee->email }}</p>
                        </div>

                        <div class="col-6 col-md-3">
                            <p class="mb-1 small text-secondary">
                                <i class="fa-solid fa-building-user"></i>
                                Department
                            </p>
                            <p class="">{{ $employee->department->name }}</p>
                        </div>

                        <div class="col-6 col-md-3">
                            <p class="mb-1 small text-secondary">
                                <i class="fa-solid fa-calendar-day"></i>
                                Joining Date
                            </p>
                            <p class="">
                                {{ \Carbon\Carbon::parse($employee->date_of_join)->format('d M Y') }}
                            </p>
                        </div>
                    </div>
                    <ul class="list-inline mt-3">
                        <li class="mb-1">
                            <span class="me-1 text-secondary small">NRC :</span>
                            {{ $employee->nrc_number }}
                        </li>
                        <li class="mb-1">
                            <span class="me-1 text-secondary small">Birthday :</span>
                            {{ \Carbon\Carbon::parse($employee->birthday)->format('d M Y') }}
                        </li>
                        <li>
                            <span class="me-1 text-secondary small">Gender :</span>
                            {{ $employee->gender }}
                        </li>
                        <li class="mt-4">
                            <p class="small text-secondary mb-1">Your Roles</p>
                            @foreach ($employee->roles as $role)
                                <span class="me-1 badge rounded-pill bg-dark">#{{ $role->name }}</span>
                            @endforeach
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
