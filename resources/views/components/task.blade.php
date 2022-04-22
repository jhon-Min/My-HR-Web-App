<div class="row my-4">
    <h5>Task</h5>
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm">
            <div class="card-header text-white fw-bold bg-warning">Pending</div>
            <div class="card-body alert-warning">
                @foreach (collect($project->tasks)->where('status', 'pending') as $task)
                    <div class="task-item mb-2">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span>{{ $task->title }}</span>
                            <div class="dropdown">
                                <div class="px-1" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                    aria-expanded="false" style="cursor: pointer">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </div>

                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li>
                                        <a class="dropdown-item edit_task_btn"
                                            data-task="{{ base64_encode(json_encode($task)) }}"
                                            data-task-members={{ base64_encode(json_encode(collect($task->members)->pluck('id')->toArray())) }}
                                            href="#">
                                            <i class="fa-solid fa-pen-to-square text-info me-1 fw-normal"></i>
                                            Edit
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item delete_task_btn" data-id="{{ $task->id }}" href="#">
                                            <i class="fa-solid fa-trash-alt text-danger me-1 fw-normal"></i>
                                            Delete
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="small mb-1">
                                    <i class="fa-solid fa-clock"></i>
                                    {{ Carbon\Carbon::parse($task->start_date)->format('M d') }}
                                </p>
                                @if ($task->priority == 'high')
                                    <p class="badge bg-danger rounded-pill mb-0">High</p>
                                @elseif($task->priority == 'middle')
                                    <p class="badge bg-info rounded-pill mb-0">Middle</p>
                                @elseif($task->priority == 'low')
                                    <p class="badge bg-dark rounded-pill mb-0">Low</p>
                                @endif
                            </div>
                            <div class="d-flex">
                                @foreach ($task->members as $member)
                                    <div class="header_img task-header-img border border-1 border-secondary">
                                        <img src="{{ $member->profile_img_path() }}" alt="">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach

                <a href="" class="add-task-item text-center mt-4 bg-white shadow-sm py-1 w-100" id="addPendingBtn">
                    <i class="fa-solid fa-circle-plus"></i>
                    Add Task
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card shadow-sm">
            <div class="card-header text-white fw-bold bg-info">In Progress</div>
            <div class="card-body alert-info">
                @foreach (collect($project->tasks)->where('status', 'in_progress') as $task)
                    <div class="task-item mb-2">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span>{{ $task->title }}</span>
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="small mb-1">
                                    <i class="fa-solid fa-clock"></i>
                                    {{ Carbon\Carbon::parse($task->start_date)->format('M d') }}
                                </p>
                                @if ($task->priority == 'high')
                                    <p class="badge bg-danger rounded-pill mb-0">High</p>
                                @elseif($task->priority == 'middle')
                                    <p class="badge bg-info rounded-pill mb-0">Middle</p>
                                @elseif($task->priority == 'low')
                                    <p class="badge bg-dark rounded-pill mb-0">Low</p>
                                @endif
                            </div>
                            <div class="d-flex">
                                @foreach ($task->members as $member)
                                    <div class="header_img task-header-img border border-1 border-secondary">
                                        <img src="{{ $member->profile_img_path() }}" alt="">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach

                <a href="" id="addInProgressBtn" class="add-task-item text-center mt-4 bg-white shadow-sm py-1 w-100">
                    <i class="fa-solid fa-circle-plus"></i>
                    Add Task
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card shadow-sm">
            <div class="card-header text-white fw-bold bg-success">Complete</div>
            <div class="card-body alert-success">
                @foreach (collect($project->tasks)->where('status', 'complete') as $task)
                    <div class="task-item mb-2">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span>{{ $task->title }}</span>
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="small mb-1">
                                    <i class="fa-solid fa-clock"></i>
                                    {{ Carbon\Carbon::parse($task->start_date)->format('M d') }}
                                </p>
                                @if ($task->priority == 'high')
                                    <p class="badge bg-danger rounded-pill mb-0">High</p>
                                @elseif($task->priority == 'middle')
                                    <p class="badge bg-info rounded-pill mb-0">Middle</p>
                                @elseif($task->priority == 'low')
                                    <p class="badge bg-dark rounded-pill mb-0">Low</p>
                                @endif
                            </div>
                            <div class="d-flex">
                                @foreach ($task->members as $member)
                                    <div class="header_img task-header-img border border-1 border-secondary">
                                        <img src="{{ $member->profile_img_path() }}" alt="">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach

                <a href="" id="addCompleteBtn" class="add-task-item text-center mt-4 bg-white shadow-sm py-1 w-100">
                    <i class="fa-solid fa-circle-plus"></i>
                    Add Task
                </a>
            </div>
        </div>
    </div>
</div>
