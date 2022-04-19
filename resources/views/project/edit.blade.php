@extends('layouts.app')

@section('title')
    Edit Project
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
                    <li class="breadcrumb-item"><a href="{{ route('project.index') }}">Projects</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Edit Project
                    </li>
                </x-bread-crumb>
            </nav>
        </div>

        <div class="col-12">
            <div class="card emp-card shadow-sm">
                <div class="card-body">
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold">Edit Project</h5>
                        <a href="{{ route('project.index') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fa-solid fa-book me-1"></i>
                            <span>Lists</span>
                        </a>
                    </div>

                    <form action="{{ route('project.update', $project->id) }}" id="editProject" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="row g-5 mb-4">
                            <div class="col-12 col-md-6">
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" id="floatingInput" name="title"
                                        value="{{ old('title', $project->title) }}" placeholder="title">
                                    <label for="floatingInput">Project Name</label>
                                </div>

                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control select-date" id="floatingInput" name="start_date"
                                        value="{{ old('start_date', Carbon\Carbon::parse($project->start_date)->format('d.m.Y')) }}"
                                        placeholder="Start Date">
                                    <label for="floatingInput">Start Date</label>
                                </div>

                                <div class="mb-5">
                                    <label for="" class="text-dark">Priority</label>
                                    <select name="priority" class="form-control">
                                        <option value="">-- Please Choose --</option>
                                        <option value="high" @if ($project->priority == 'high') selected @endif>High</option>
                                        <option value="middle" @if ($project->priority == 'middle') selected @endif>Middle
                                        </option>
                                        <option value="low" @if ($project->priority == 'low') selected @endif>Low</option>
                                    </select>
                                </div>

                                <div class="">
                                    <label>Project Leaders</label>
                                    <select class="form-control select-custom-multiple" name="leaders[]" multiple>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}"
                                                @if (in_array(
    $employee->id,
    collect($project->leaders)->pluck('id')->toArray(),
)) selected @endif>
                                                {{ $employee->name }}
                                                ({{ $employee->employee_id }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" id="floatingInput" name="description"
                                        value="{{ old('description', $project->description) }}" placeholder="description">
                                    <label for="floatingInput">Description</label>
                                </div>

                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control select-date" id="floatingInput" name="deadline"
                                        value="{{ old('deadline', Carbon\Carbon::parse($project->deadline)->format('d.m.Y')) }}"
                                        placeholder="Deadline">
                                    <label for="floatingInput">Deadline</label>
                                </div>

                                <div class="mb-5">
                                    <label for="" class="text-dark">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="">-- Please Choose --</option>
                                        <option value="pending" @if ($project->status == 'pending') selected @endif>Pending
                                        </option>
                                        <option value="in_progress" @if ($project->status == 'in_progress') selected @endif>In
                                            Progress</option>
                                        <option value="complete" @if ($project->status == 'complete') selected @endif>Complete
                                        </option>
                                    </select>
                                </div>

                                <div class="">
                                    <label>Project Members</label>
                                    <select class="form-control select-custom-multiple" name="members[]" multiple>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}"
                                                @if (in_array(
    $employee->id,
    collect($project->members)->pluck('id')->toArray(),
)) selected @endif>
                                                {{ $employee->name }}
                                                ({{ $employee->employee_id }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                        </div>

                        <div class="mb-4">
                            <label for="" class="text-muted">Files (Only PDF)</label>
                            <input type="file" class="form-control pdf-form p-1" name="files[]" multiple
                                accept="application/pdf">
                            <div class="my-2">
                                @if ($project->files)
                                    @foreach ($project->files as $file)
                                        <a href="{{ asset('storage/project/' . $file) }}" class="pdf-thumbnail"
                                            target="_blank"><i class="fas fa-file-pdf"></i>
                                            <p class="mb-0 small">File {{ $loop->iteration }}</p>
                                        </a>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="form-group mb-5">
                            <label for="profile_img" class="text-muted">Images</label>
                            <input type="file" name="photos[]" class="form-control p-1 d-none" id="profile_img" multiple
                                accept="image/.png,.jpg,.jpeg">

                            <div class="border rounded p-3 @error('photos') broder border-danger @enderror">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex justify-content-center align-items-center bg-light border py-2 px-3 emp-profile"
                                        id="upload-ui">
                                        <i class="fas fa-upload fs-4"></i>
                                    </div>

                                    <div class="preview_img my-2 ms-3">
                                        @if ($project->photos)
                                            @foreach ($project->photos as $photo)
                                                <img src="{{ asset('storage/project/' . $photo) }}" alt="">
                                            @endforeach
                                        @else
                                            <p>No Photo</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @error('photos')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @error('photos.*')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="text-center mt-5 mb-3">
                            <a href="{{ route('project.index') }}" class="btn btn-danger ">Cancel</a>
                            <button class="btn btn-primary px-5 ms-2">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\UpdateProjectRequest', '#editProject') !!}
    <script>
        $(".single-select").select2({
            theme: "bootstrap-5",
            width: '100%',
            placeholder: $(this).data("placeholder"),
            dropdownCssClass: "select2--small",
            //   allowClear: true,
        });

        $('.select-custom-multiple').select2({
            theme: "bootstrap-5",
            width: '100%',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: true,
        });

        $(".select-date").flatpickr({
            dateFormat: "d.m.Y",
        });

        let input = document.getElementById('profile_img');
        document.getElementById('upload-ui').addEventListener("click", _ => input.click());

        $('#profile_img').on('change', function() {
            var file_length = input.files.length;
            $('.preview_img').html('');
            for (var i = 0; i < file_length; i++) {
                $('.preview_img').append(`<img src="${URL.createObjectURL(event.target.files[i])}"/>`);
            }
        });
    </script>
@endsection
