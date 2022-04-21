@extends('layouts.app')

@section('title')
    {{ $project->title }}
@endsection

@section('head')
    <style>
        .show-img {
            width: 60px;
            border: 1px solid #ddd;
            border-radius: 15px;
        }

        .alert-warning {
            background-color: #fff3cd66;
        }

        .alert-info {
            background-color: #cff4fc66;
        }

        .alert-success {
            background-color: #d1e7dd66;
        }

        .task-item {
            padding: 8px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .add-task-item {
            display: block;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-control[readonly] {
            background-color: transparent;
        }

        .select2-container {
            z-index: 5555;
        }

        .select2-container--bootstrap-5 .select2-selection {
            border: 1px solid #ddd !important;
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

        <div class="col-12 col-md-8">
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
                    <p class="mt-3 mb-4 project-desc">{{ $project->description }}</p>

                    <div class="mb-3">
                        <h6 class="mb-1 small fw-bold">Leaders</h6>
                        @forelse ($project->leaders as $leader)
                            <img src="{{ asset($leader->profile_img_path()) }}" alt=""
                                class="leader-thumb-1 shadow-sm me-1 mb-2">
                        @empty
                            <small class="text-semi text-center">No Leader Here</small>
                        @endforelse
                    </div>

                    <div>
                        <h6 class="mb-1 small fw-bold">Members</h6>
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

        <div class="col-12 col-md-4">
            <div class="col-12 mb-3">
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
            </div>

            <div class="col-12">
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
        </div>

        {{-- Task Manager --}}
        <div class="row my-4">
            <h5>Task</h5>
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header text-white fw-bold bg-warning">Pending</div>
                    <div class="card-body alert-warning">
                        <div class="task-item mb-2">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>User Crud ရေးရန်</span>
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="small mb-1">
                                        <i class="fa-solid fa-clock"></i>
                                        Sep 12
                                    </p>
                                    <p class="badge bg-danger rounded-pill mb-0">
                                        High
                                    </p>
                                </div>
                                <div class="header_img border border-1 border-secondary">
                                    <img src="{{ auth()->user()->profile_img_path() }}" alt="">
                                </div>
                            </div>
                        </div>

                        <a href="" class="add-task-item text-center mt-4 bg-white shadow-sm py-1 w-100" id="addPendingBtn">
                            <i class="fa-solid fa-circle-plus"></i>
                            Add Task
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header text-white fw-bold bg-info">In Progress</div>
                    <div class="card-body alert-info">
                        <div class="task-item mb-2">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>User Crud ရေးရန်</span>
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="small mb-1">
                                        <i class="fa-solid fa-clock"></i>
                                        Sep 12
                                    </p>
                                    <p class="badge bg-danger rounded-pill mb-0">
                                        High
                                    </p>
                                </div>
                                <div class="header_img border border-1 border-secondary">
                                    <img src="{{ auth()->user()->profile_img_path() }}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="task-item mb-2">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>User Crud ရေးရန်</span>
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="small mb-1">
                                        <i class="fa-solid fa-clock"></i>
                                        Sep 12
                                    </p>
                                    <p class="badge bg-danger rounded-pill mb-0">
                                        High
                                    </p>
                                </div>
                                <div class="header_img border border-1 border-secondary">
                                    <img src="{{ auth()->user()->profile_img_path() }}" alt="">
                                </div>
                            </div>
                        </div>

                        <a href="" class="add-task-item text-center mt-4 bg-white shadow-sm py-1 w-100 ">
                            <i class="fa-solid fa-circle-plus"></i>
                            Add Task
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header text-white fw-bold bg-success">Complete</div>
                    <div class="card-body alert-success">
                        <div class="task-item mb-2">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>User Crud ရေးရန်</span>
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="small mb-1">
                                        <i class="fa-solid fa-clock"></i>
                                        Sep 12
                                    </p>
                                    <p class="badge bg-danger rounded-pill mb-0">
                                        High
                                    </p>
                                </div>
                                <div class="header_img border border-1 border-secondary">
                                    <img src="{{ auth()->user()->profile_img_path() }}" alt="">
                                </div>
                            </div>
                        </div>

                        <a href="" class="add-task-item text-center mt-4 bg-white shadow-sm py-1 w-100">
                            <i class="fa-solid fa-circle-plus"></i>
                            Add Task
                        </a>
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

        var leaders = @json($project->leaders);
        var members = @json($project->members);

        $('#addPendingBtn').click(function(event) {
            event.preventDefault();

            var task_members_options = '';
            leaders.forEach(function(leader) {
                task_members_options += `<option value="${leader.id}">${leader.name}</option>`;
            });
            members.forEach(function(member) {
                task_members_options += `<option value="${member.id}">${member.name}</option>`;
            });

            Swal.fire({
                title: 'Add Pending Task',
                html: `
                    <form id="pending_task_form" class="task-form">
                        <input type="hidden" name="project_id" value="{{ $project->id }}" />
                        <input type="hidden" name="status" value="pending"/>

                        <div class="mb-3 text-start">
                            <label class="small">Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Project Title">
                        </div>

                        <div class="mb-3 text-start">
                            <label class="small">Description</label>
                            <textarea name="description" class="form-control" rows="5"></textarea>
                        </div>


                        <div class="mb-3 text-start">
                            <label class="small">Start Date</label>
                            <input type="text" class="form-control select-date" name="start_date" placeholder="Start Date">
                        </div>

                        <div class="mb-3 text-start">
                            <label class="small">Deadline</label>
                            <input type="text" class="form-control select-date" name="deadline" placeholder="Deadline">
                        </div>

                        <div class="mb-3 text-start">
                            <label for="" class="small">Members</label>
                            <select class="form-control select-custom-multiple" name="members[]" multiple>
                                <option value="">-- Please Choose --</option>
                                ${task_members_options}
                        </select>

                        </div>

                        <div class="mb-4 text-start">
                            <label for="" class="small">Priority</label>
                            <select name="priority" class="form-control">
                                <option value="">-- Please Choose --</option>
                                <option value="high">High</option>
                                <option value="middle">Middle</option>
                                <option value="low">Low</option>
                            </select>
                        </div>
                    </form>
                `,
                showCancelButton: true,
                focusConfirm: true,
                confirmButtonText: '<i class="fa fa-thumbs-up"></i> Confirm',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    var form_data = $('#pending_task_form').serialize();
                    $.ajax({
                        url: `/task`,
                        type: 'POST',
                        data: form_data,
                        success: function(res) {
                            console.log(res);
                        }
                    });

                    Swal.fire('Saved!', '', 'success')
                }
            })

            $(".select-date").flatpickr({
                dateFormat: "d.m.Y",
            });

            $('.select-custom-multiple').select2({
                theme: "bootstrap-5",
                width: '100%',
                placeholder: $(this).data('placeholder'),
                closeOnSelect: true,
            });
        })
    </script>
@endsection
