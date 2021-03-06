<?php

namespace Skoro\AdminPack\Http\Controllers;

use Skoro\AdminPack\Http\Requests\RoleRequest;
use Skoro\AdminPack\Models\Role;
use Skoro\AdminPack\Services\RoleService;

/**
 * Role and permissions management controller.
 */
class RoleController extends AdminController
{
    protected RoleService $roleService;

    /**
     * @param RoleService $roleService
     */
    public function __construct(RoleService $roleService)
    {
        $this->middleware('can:manageRoles');
        $this->roleService = $roleService;
    }

    /**
     * Roles index.
     */
    public function index()
    {
        return view('admin::roles.index');
    }

    /**
     * Shows a new role page.
     */
    public function create()
    {
        return view('admin::roles.create');
    }

    /**
     * Store a newly created role.
     *
     * @param  RoleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = $this->roleService->create(
            $request->getName(),
            $request->getPermissions()
        );

        toast(__('Role ":role" has been created.', [
            'role' => $role->name,
        ]));

        return redirect()->route('admin.roles');
    }

    /**
     * Edit the role.
     */
    public function edit(Role $role)
    {
        $canDelete = $role->users()->count() == 0;

        return view('admin::roles.edit', [
            'role' => $role,
            'canDelete' => $canDelete,
        ]);
    }

    /**
     * Update the role.
     */
    public function update(RoleRequest $request, Role $role)
    {
        $this->roleService->update(
            $role,
            $request->getName(),
            $request->getPermissions()
        );

        toast(__('Role ":role" has been updated.', [
            'role' => $role->name,
        ]));

        return redirect()->route('admin.roles');
    }

    /**
     * Delete the role.
     */
    public function destroy(Role $role)
    {
        try{
            $this->roleService->delete($role);

            toast(__('Role ":role" has been deleted.', [
                'role' => $role->name,
            ]));

        } catch (\Exception $e) {
            alert('error', __($e->getMessage()));
        }

        return redirect()->route('admin.roles');
    }
}