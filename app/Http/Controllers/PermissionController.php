<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    public function ssd(Request $request)
    {
        $permission = Permission::query();
        return DataTables::of($permission)
            ->editColumn('updated_at', function ($each) {
                return Carbon::parse($each->update_at)->format('Y-m-d H:i:s');
            })
            ->addColumn('action', function ($each) {
                $edit = "";
                $del = "";

                $edit = '<a href="'.route('permission.edit', $each->id).'" class="btn btn-success btn-sm rounded-circle"><i class="fa-solid fa-pen-to-square fw-light"></i></a>';

                $del = '<a href="#" class="btn btn-danger btn-sm rounded-circle del-btn ms-2" data-id="' . $each->id . '"><i class="fa-solid fa-trash-alt fw-light"></i></a>';

                return '<div class="action-icon">' . $edit  . $del. '</div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function index()
    {
        return view('permission.index');
    }

    public function create()
    {
        return view('permission.create');
    }

    public function store(StorePermissionRequest $request)
    {
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->save();

        return redirect()->route('permission.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Created', 'message' => 'Permission is successfully created']);
    }

    public function edit(Permission $permission)
    {
        return view('permission.edit', compact('permission'));
    }

    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $permission->name = $request->name;
        $permission->update();

        return redirect()->route('permission.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Updated', 'message' => 'Permission is successfully updated']);
    }

    public function destroy(Permission $permission)
    {
        return $permission->delete();
    }
}
