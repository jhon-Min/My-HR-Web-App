<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function ssd(Request $request)
    {
        $role = Role::query();
        return DataTables::of($role)
            ->editColumn('updated_at', function ($each) {
                return Carbon::parse($each->update_at)->format('Y-m-d H:i:s');
            })
            // ->addColumn('plus-icon', function ($each) {
            //     return null;
            // })
            ->addColumn('action', function ($each) {
                $edit = "";
                $del = "";

                $edit = '<a href="'.route('role.edit', $each->id).'" class="btn btn-success btn-sm rounded-circle"><i class="fa-solid fa-pen-to-square fw-light"></i></a>';

                $del = '<a href="#" class="btn btn-danger btn-sm rounded-circle del-btn ms-2" data-id="' . $each->id . '"><i class="fa-solid fa-trash-alt fw-light"></i></a>';

                return '<div class="action-icon">' . $edit  . $del. '</div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function index()
    {
        return view('role.index');
    }

    public function create()
    {
        return view('role.create');
    }

    public function Store(StoreRoleRequest $request)
    {
        $role = new Role();
        $role->name = $request->name;
        $role->save();

        return redirect()->route('role.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Created', 'message' => $role->name . ' role is successfully created']);
    }

    public function edit(Role $role)
    {
        return view('role.edit', compact('role'));
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $beforeName = $role->name;
        $role->name = $request->name;
        $role->update();

        return redirect()->route('role.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Updated', 'message' => $beforeName . ' to ' . $role->name]);
    }

    public function destroy(Role $role)
    {
        return $role->delete();
    }
}
