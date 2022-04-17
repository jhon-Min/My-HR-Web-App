@extends('layouts.app')

@section('title')
    Employee Lists
@endsection


@section('content')
    <div class="row">
        <div class="my-4 d-flex align-items-baseline">
            <div class="me-2">
                <span class="fs-4">Profile</span>
                <span class="fs-4 ms-1 text-muted">|</span>
            </div>
            <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
                <x-bread-crumb>
                    <li class="breadcrumb-item active" aria-current="page">
                        User Profile
                    </li>
                </x-bread-crumb>
            </nav>
        </div>

        <div class="col-12 col-md-5 col-lg-4 mb-3 mb-md-0">
            <form action="{{ route('profile.update-profile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card profile-card shadow">
                    <div class="text-center">
                        <div class="bg-dark py-5">
                        </div>

                        <img src="{{ auth()->user()->profile_img_path() }}"
                            class="border border-2 border-primary rounded-circle profile-img" alt="User Profile">

                        <div>
                            <i class="fa-solid fa-square-pen text-primary fs-4 profile-btn d-inline-block"></i>
                        </div>

                        <input type="file" name="profile_img" class="d-none" id="profile-input">
                    </div>
                    <div class="card-body text-center mt-2">
                        <h5 class="fw-bold text-secondary">{{ $user->name }}</h5>
                        <p class="small mb-1">{{ $user->address }}</p>
                        <p class="small mb-4">
                            <i class="fa-solid fa-square-phone me-1 text-success"></i>
                            {{ $user->phone }}
                        </p>

                        <div>
                            <a href="{{ route('profile.index') }}" class="btn btn-sm btn-danger me-1">Cancel</a>
                            <button class="btn btn-sm btn-primary px-4">Save</button>
                        </div>
                    </div>
                </div>
            </form>
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
                            <p class="">{{ $user->employee_id }}</p>
                        </div>

                        <div class="col-6 col-md-3">
                            <p class="mb-1 small text-secondary">
                                <i class="fa-solid fa-envelope"></i>
                                Email
                            </p>
                            <p class="">{{ $user->email }}</p>
                        </div>

                        <div class="col-6 col-md-3">
                            <p class="mb-1 small text-secondary">
                                <i class="fa-solid fa-building-user"></i>
                                Department
                            </p>
                            <p class="">{{ $user->department->name }}</p>
                        </div>

                        <div class="col-6 col-md-3">
                            <p class="mb-1 small text-secondary">
                                <i class="fa-solid fa-calendar-day"></i>
                                Joining Date
                            </p>
                            <p class="">{{ \Carbon\Carbon::parse($user->date_of_join)->format('d M Y') }}
                            </p>
                        </div>
                    </div>
                    <ul class="list-inline mt-3">
                        <li class="mb-1">
                            <span class="me-1 text-secondary small">NRC :</span>
                            {{ $user->nrc_number }}
                        </li>
                        <li class="mb-1">
                            <span class="me-1 text-secondary small">Birthday :</span>
                            {{ \Carbon\Carbon::parse($user->birthday)->format('d M Y') }}
                        </li>
                        <li>
                            <span class="me-1 text-secondary small">Gender :</span>
                            {{ $user->gender }}
                        </li>
                        <li class="mt-4">
                            <p class="small text-secondary mb-1">Your Roles</p>
                            @foreach ($user->roles as $role)
                                <span class="me-1 badge rounded-pill bg-dark">#{{ $role->name }}</span>
                            @endforeach
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let profile = document.querySelector(".profile-img");
        let addBtn = document.querySelector(".profile-btn")
        let input = document.querySelector("#profile-input");
        addBtn.addEventListener("click", _ => input.click())
        input.addEventListener("change", _ => {
            let file = input.files[0];
            let reader = new FileReader();
            reader.onload = function() {
                profile.src = reader.result;
            }
            reader.readAsDataURL(file);
        })
    </script>
@endsection
