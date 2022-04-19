<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function ssd(Request $request)
    {
        // $this->checking('view_role');
        $role = Role::query();
        return DataTables::of($role)
            ->editColumn('updated_at', function ($each) {
                return Carbon::parse($each->update_at)->format('Y-m-d H:i:s');
            })
            ->addColumn('permissions', function ($each) {
                $output = '';
                foreach ($each->permissions as $permission) {
                    $output .= "<span class='badge rounded-pill bg-dark m-1'>$permission->name</span>";
                }
                return $output;
            })
            ->addColumn('action', function ($each) {
                $edit = "";
                $del = "";

                if (auth()->user()->can('edit_role')) {
                    $edit = '<a href="'.route('role.edit', $each->id).'" class="btn btn-success btn-sm rounded-circle"><i class="fa-solid fa-pen-to-square fw-light"></i></a>';
                }
                if (auth()->user()->can('delete_role')) {
                    $del = '<a href="#" class="btn btn-danger btn-sm rounded-circle del-btn ms-2" data-id="' . $each->id . '"><i class="fa-solid fa-trash-alt fw-light"></i></a>';
                }

                return '<div class="action-icon">' . $edit  . $del. '</div>';
            })
            ->rawColumns(['action', 'permissions'])
            ->make(true);
    }

    public function index()
    {
        // $this->checking('view_role');
        return view('role.index');
    }

    public function create()
    {
        // $this->checking('create_role');
        $permissions = Permission::all();
        return view('role.create', compact('permissions'));
    }

    public function Store(StoreRoleRequest $request)
    {
        // $this->checking('create_role');
        $role = new Role();
        $role->name = $request->name;
        $role->save();

        // assign role permission to pivot table
        $role->givePermissionTo($request->permissions);

        return redirect()->route('role.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Created', 'message' => $role->name . ' role is successfully created']);
    }

    public function edit(Role $role)
    {
        // $this->checking('edit_role');
        $old_permissions = $role->permissions->pluck('id')->toArray();
        $permissions = Permission::all();
        return view('role.edit', compact('role', 'old_permissions', 'permissions'));
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        // $this->checking('edit_role');
        $old_permissions = $role->permissions->pluck('name')->toArray();
        $role->name = $request->name;
        $role->update();

        // if($old_permissions){
        //     $role->revokePermissionTo($old_permissions);
        // }
        // $role->givePermissionTo($request->permissions);

        $role->syncPermissions($request->permissions); // revoke old data and give new data

        return redirect()->route('role.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Updated', 'message' => $role->name . 'is successfully Updated']);
    }

    public function destroy(Role $role)
    {
        // $this->checking('delete_role');
        return $role->delete();
    }
}
