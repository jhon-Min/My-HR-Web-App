@extends('layouts.app')

@section('title')
    {{ $project->title }}
@endsection

@section('head')
    <style>
        .show-img {
            width: 120px;
            border-radius: 15px;
        }

    </style>
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
                    <li class="breadcrumb-item"><a href="{{ route('project.index') }}">Project Lists</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Detail
                    </li>
                </x-bread-crumb>
            </nav>
        </div>

        <div class="col-12 col-md-8 col-lg-9">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                        <p class="h3">{{ $project->title }}</p>
                        <p class="mb-0">
                            <span class="small text-primary">Start Date: {{ $project->start_date }}</span>
                            <span class="small mx-2">|</span>
                            <span class="small text-primary">Deadline: {{ $project->deadline }}</span>
                        </p>
                    </div>

                    <div class="d-flex">
                        <p class="text-semi d-flex align-items-center">
                            <span class="me-1">Priority:</span>
                            @if ($project->priority == 'high')
                                <span class="badge bg-danger rounded-pill">High</span>
                            @elseif($project->priority == 'middle')
                                <span class="badge bg-info rounded-pill">Middle</span>
                            @elseif($project->priority == 'low')
                                <span class="badge bg-dark rounded-pill">Low</span>
                            @endif
                        </p>
                        <p class="mx-2"></p>
                        <p class="text-semi d-flex align-items-center">
                            <span class="me-1">Status:</span>
                            @if ($project->status == 'pending')
                                <span class="badge bg-warning rounded-pill">Pending</span>
                            @elseif($project->status == 'in_progress')
                                <span class="badge bg-info rounded-pill">In Progress</span>
                            @elseif($project->status == 'complete')
                                <span class="badge bg-success rounded-pill">Complete</span>
                            @endif
                        </p>
                    </div>
                    <p class="mt-3 project-desc">{{ $project->description }}</p>
                </div>
            </div>

            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h5 class="mb-3">Images</h5>
                    <div id="imgs">
                        @isset($project->photos)
                            @foreach ($project->photos as $photo)
                                <img src="{{ asset('storage/project/' . $photo) }}" alt=""
                                    class="show-img shadow-sm me-1 mb-2">
                            @endforeach
                        @else
                            <p class="text-semi text-center">No Image Here</p>
                        @endisset
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="mb-3">Files</h5>
                    @isset($project->files)
                        @foreach ($project->files as $file)
                            <a href="{{ asset('storage/project/' . $file) }}" class="pdf-thumbnail" target="_blank"><i
                                    class="fas fa-file-pdf"></i>
                                <p class="mb-0 small">File {{ $loop->iteration }}</p>
                            </a>
                        @endforeach
                    @else
                        <p class="text-semi text-center">No File Here</p>
                    @endisset
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 col-lg-3">
            <div class="col-12 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6 class="mb-3">Leaders</h6>
                        @forelse ($project->leaders as $leader)
                            <img src="{{ asset($leader->profile_img_path()) }}" alt=""
                                class="leader-thumb-1 shadow-sm me-1 mb-2">
                        @empty
                            <small class="text-semi text-center">No Leader Here</small>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6 class="mb-3">Members</h6>
                        @forelse ($project->members as $member)
                            <img src="{{ asset($member->profile_img_path()) }}" alt=""
                                class="member-thumb-1 shadow-sm me-1 mb-2">
                        @empty
                            <small class="text-semi text-center">No Member Here</small>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            new Viewer(document.getElementById('imgs'));
        })
    </script>
@endsection
