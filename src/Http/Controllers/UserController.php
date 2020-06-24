<?php

namespace Skoro\AdminPack\Http\Controllers;

use Skoro\AdminPack\Http\Requests\UserRequest;
use Skoro\AdminPack\Http\Resources\UserResource;
use Skoro\AdminPack\Services\User\CreateUserService;
use Skoro\AdminPack\Services\User\UpdateUserService;
use Skoro\AdminPack\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * User controller.
 */
class UserController extends AdminController
{

    public function __construct()
    {
        // $this->authorizeResource(User::class, 'user');
    }

    public function data(Request $request)
    {
        $request->validate([
            'sort' => 'nullable|in:id,name,email,role,created',
            'order' => 'required_with:sort|in:asc,desc',
        ]);

        // TODO: it should be a repository for sorting ?
        $sort = $request->sort;
        if ($sort) {
            switch ($sort) {
                case 'created':
                    $sortField = 'created_at';
                    break;
                case 'role':
                    $sortField = 'roles.name';
                    break;
                default:
                    $sortField = $sort;
            }
            $query = User::orderBy($sortField, $request->order);
            switch ($sort) {
                case 'role':
                    $query
                        ->select('users.*')
                        ->join('roles', 'roles.id', '=', 'users.role_id');
                    break;
            }
            $users = $query->paginate();
        } else {
            $users = User::paginate();
        }
        
        return UserResource::collection($users);
    }

    /**
     * Store a newly created user.
     *
     * @param  UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request, CreateUserService $createUser)
    {
        $user = $createUser->create($request->getUserDto());

        toast(__('User ":user" has been created.', [
            'user' => $user->name,
        ]));

        return $this->redirectToList();
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin::users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified user.
     *
     * @param UserRequest $request
     * @param User        $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user, UpdateUserService $updateUser)
    {
        $updateUser->update($user, $request->getUserDto());
        
        if (auth()->id() == $user->id) {
            toast(__('Your profile has been updated.'));
        } else {
            toast(__('User ":user" has been updated.', [
                'user' => $user->name,
            ]));
        }

        return $this->redirectToList();
    }

    /**
     * Remove the specified user.
     *
     * @param User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->delete()) {
            toast(__('User ":user" has been deleted.', [
                'user' => $user->name,
            ]));
        }

        return $this->redirectToList();
    }

    protected function redirectToList(): RedirectResponse
    {
        return redirect()->route('admin.users');
    }
}
