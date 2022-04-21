<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Carbon\Carbon;

class TaskController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        $task = new Task();
        $task->project_id = $request->project_id;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->start_date = Carbon::parse($request->start_date)->format('Y-m-d');
        $task->deadline = Carbon::parse($request->deadline)->format('Y-m-d');
        $task->priority = $request->priority;
        $task->status = $request->status;
        $task->save();

        $task->members()->sync($request->members);

        return 'success';
    }

}
