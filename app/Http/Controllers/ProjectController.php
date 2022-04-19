<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('project.index');
    }

    public function ssd(Request $request)
    {
        $projects = Project::with('leaders', 'members');
        return DataTables::of($projects)
            ->editColumn('updated_at', function ($each) {
                return Carbon::parse($each->update_at)->format('Y-m-d H:i:s');
            })
            // ->editColumn('description', function ($each) {
            //     return Str::limit($each->description, 50, ' ....');
            // })
            ->editColumn('start_date', function($each){
                return Carbon::parse($each->start_date)->format('d.m.Y');
            })
            ->editColumn('deadline', function($each){
                return Carbon::parse($each->deadline)->format('d.m.Y');
            })
            ->addColumn('leaders', function ($each) {
                $output = "<div class=' position-absolute'>";
                foreach ($each->leaders as $leader) {
                    $output .= '<img src="' . $leader->profile_img_path() . '" alt="" class="leader-thumb-2 shadow-sm">';
                }

                return $output;
            })
            ->addColumn('members', function ($each) {
                $output = "<div class=' position-absolute'>";
                foreach ($each->members as $member) {
                    $output .= '<img src="' . $member->profile_img_path() . '" alt="" class="member-thumb-2 shadow-sm">';
                }

                return $output;
            })
            ->editColumn('status', function ($each) {
                if ($each->status == 'pending') {
                    return "<span class='badge rounded-pill bg-warning p-1'>Pending</span>";
                } else if ($each->status == 'in_progress') {
                    return "<span class='badge rounded-pill bg-info p-1'>In Progress</span>";
                } else if ($each->status == 'complete') {
                    return "<span class='badge rounded-pill bg-success p-1'>Complete</span>";
                }
            })
            ->editColumn('priority', function ($each) {
                if ($each->priority == 'high') {
                    return "<span class='badge rounded-pill bg-danger p-1'>High</span>";
                } else if ($each->priority == 'middle') {
                    return "<span class='badge rounded-pill bg-info p-1'>Middle</span>";
                } else if ($each->priority == 'low') {
                    return "<span class='badge rounded-pill bg-dark p-1'>Low</span>";
                }
            })
            ->addColumn('plus-icon', function ($each) {
                return null;
            })
            ->addColumn('action', function ($each) {
                $edit = '';
                $del = '';
                $detail = '';

                $edit = '<a href="'.route('project.edit', $each->id).'" class="btn me-1 btn-success btn-sm rounded-circle"><i class="fa-solid fa-pen-to-square fw-light"></i></a>';

                $del = '<a href="#" class="btn btn-danger btn-sm rounded-circle del-btn" data-id="' . $each->id . '"><i class="fa-solid fa-trash-alt fw-light"></i></a>';

                $detail = '<a href="' . route('project.show', $each->id) . '" class="btn btn-secondary btn-sm rounded-circle me-1"><i class="fa-solid fa-circle-info"></i></a>';

                return '<div class="action-icon">' . $edit . $detail . $del . '</div>';
            })
            ->rawColumns(['action', 'status', 'priority', 'leaders', 'members'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = User::orderBy('name')->get();
        return view('project.create', compact('employees'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $photos = null;
        if ($request->hasFile('photos')) {
            $photos = [];
            $photo_files = $request->file('photos');
            foreach ($photo_files as $photo_file) {
                $newName = 'project_' . uniqid() . '.' . $photo_file->getClientOriginalExtension();
                Storage::disk('public')->put('project/' . $newName, file_get_contents($photo_file));
                $photos[] = $newName;
            }
        }

        $files = null;
        if ($request->hasFile('files')) {
            $files = [];
            $file_names = $request->file('files');
            foreach ($file_names as $file_name) {
                $newName = 'project_' . uniqid() . '.' . $file_name->getClientOriginalExtension();
                Storage::disk('public')->put('project/' . $newName, file_get_contents($file_name));
                $files[] = $newName;
            }
        }

        $project = new Project();
        $project->title = $request->title;
        $project->description = $request->description;
        $project->photos = $photos;
        $project->files = $files;
        $project->start_date = Carbon::parse($request->start_date)->format('Y-m-d');
        $project->deadline =Carbon::parse($request->deadline)->format('Y-m-d');
        $project->priority = $request->priority;
        $project->status = $request->status;
        $project->save();

        $project->leaders()->sync($request->leaders);
        $project->members()->sync($request->members);

        return redirect()->route('project.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Created', 'message' => $project->title . ' is successfully created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('project.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $employees = User::orderBy('name')->get();
        return view('project.edit', compact('project', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $photos = $project->photos;
        if ($request->hasFile('photos')) {
            $photos = [];
            $photo_files = $request->file('photos');
            foreach ($photo_files as $photo_file) {
                $newName = 'project_' . uniqid() . '.' . $photo_file->getClientOriginalExtension();
                Storage::disk('public')->put('project/' . $newName, file_get_contents($photo_file));
                $photos[] = $newName;
            }
        }

        $files = $project->files;
        if ($request->hasFile('files')) {
            $files = [];
            $file_names = $request->file('files');
            foreach ($file_names as $file_name) {
                $newName = 'project_' . uniqid() . '.' . $file_name->getClientOriginalExtension();
                Storage::disk('public')->put('project/' . $newName, file_get_contents($file_name));
                $files[] = $newName;
            }
        }

        $project->title = $request->title;
        $project->description = $request->description;
        $project->photos = $photos;
        $project->files = $files;
        $project->start_date = Carbon::parse($request->start_date)->format('Y-m-d');
        $project->deadline = Carbon::parse($request->deadline)->format('Y-m-d');
        $project->priority = $request->priority;
        $project->status = $request->status;
        $project->update();


        $project->leaders()->sync($request->leaders);
        $project->members()->sync($request->members);

        return redirect()->route('project.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Updated', 'message' => $project->title . ' is successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if ($project->photos) {
            foreach ($project->photos as $photo) {
                Storage::disk('public')->delete('project/' . $photo);
            }
        }

        if ($project->files) {
            foreach ($project->files as $pdf) {
                Storage::disk('public')->delete('project/' . $pdf);
            }
        }

        $project->leaders()->detach();
        $project->members()->detach();
        $project->delete();
    }

}
