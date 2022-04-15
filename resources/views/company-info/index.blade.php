@extends('layouts.app')

@section('title')
    Company Information
@endsection


@section('content')
    <div class="row">
        <div class="my-4 d-flex align-items-baseline">
            <div class="me-2">
                <span class="fs-4">Company</span>
                <span class="fs-4 ms-1 text-muted">|</span>
            </div>
            <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
                <x-bread-crumb>
                    <li class="breadcrumb-item active" aria-current="page">
                        Company Info
                    </li>
                </x-bread-crumb>
            </nav>
        </div>

        <div class="col-12">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 col-md-3 mb-3 mb-md-0 text-center">
                            <h1 class="mb-1 text-success">{{ $companyInfo->office_start_time }}</h1>
                            <p class="text-secondary">
                                <i class="fa-solid fa-clock"></i>
                                Office Start
                            </p>
                        </div>

                        <div class="col-6 col-md-3 mb-3 mb-md-0 text-center">
                            <h1 class="mb-1 text-success @if ($companyInfo->break_start_time) text-danger @endif">
                                {{ $companyInfo->break_start_time }}</h1>
                            <p class="text-secondary">
                                <i class="fa-solid fa-circle-stop"></i>
                                Break Start Time
                            </p>
                        </div>

                        <div class="col-6 col-md-3 text-center">
                            <h1 class="mb-1 text-success  @if ($companyInfo->break_end_time) text-danger @endif"">{{ $companyInfo->break_end_time }}</h1>
                                                        <p class="       text-secondary">
                                <i class="fa-solid fa-circle-stop"></i>
                                Break End Time
                                </p>
                        </div>

                        <div class="col-6 col-md-3 text-center">
                            <h1 class="mb-1 text-success">{{ $companyInfo->office_end_time }}</h1>
                            <p class="text-secondary">
                                <i class="fa-solid fa-clock"></i>
                                Office End
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 col-md-3 mb-3 mb-md-0 text-center">
                            <p class="mb-1 small text-secondary">
                                <i class="fa-solid fa-building me-1"></i>
                                Company Name
                            </p>
                            <p class="">{{ $companyInfo->name }}</p>
                        </div>

                        <div class="col-6 col-md-3 mb-3 mb-md-0 text-center">
                            <p class="mb-1 small text-secondary">
                                <i class="fa-solid fa-at me-1"></i>
                                Email
                            </p>
                            <p class="">{{ $companyInfo->email }}</p>
                        </div>

                        <div class="col-6 col-md-3 text-center">
                            <p class="mb-1 small text-secondary">
                                <i class="fa-solid fa-square-phone me-1"></i>
                                Phone
                            </p>
                            <p class="">{{ $companyInfo->phone }}</p>
                        </div>

                        <div class="col-6 col-md-3 text-center">
                            <p class="mb-1 small text-secondary">
                                <i class="fa-solid fa-map-location-dot me-1"></i>
                                Address
                            </p>
                            <p class="">{{ $companyInfo->address }}</p>
                        </div>
                    </div>
                </div>
            </div>

            @can('edit_company')
                <div class="text-center mt-5">
                    <a href="{{ route('company-info.edit', $companyInfo->id) }}" class="btn btn-primary px-4">Change Info</a>
                </div>
            @endcan
        </div>
    </div>
@endsection

@section('scripts')
    <script>

    </script>
@endsection
