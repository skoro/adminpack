<?php

namespace Skoro\AdminPack\Http\Controllers;

use Skoro\AdminPack\Http\Requests\UserRequest;
use Skoro\AdminPack\Http\Resources\UserResource;
use Skoro\AdminPack\Services\User\CreateUserService;
use Skoro\AdminPack\Services\User\UpdateUserService;
use Skoro\AdminPack\Models\User;
use Illuminate\Http\RedirectResponse;
use Skoro\AdminPack\Http\Requests\UserDataRequest;
use Skoro\AdminPack\Repositories\UsersPaginateQuery;

/**
 * User controller.
 */
class UserController extends AdminController
{

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Show the users list page.
     */
    public function index()
    {
        return view('admin::users.index');
    }

    /**
     * Returns a users collection.
     *
     * @param UserDataRequest    $request
     * @param UsersPaginateQuery $usersPaginateQuery
     */
    public function data(UserDataRequest $dataRequest, UsersPaginateQuery $usersPaginateQuery)
    {
        $dto = $dataRequest->getQueryDto();
        $users = $usersPaginateQuery->paginate($dto, $dataRequest->getLimit());

        return UserResource::collection($users);
    }

    /**
     * Show a create user form.
     */
    public function create()
    {
        return view('admin::users.create');
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
        
        toast(__('User ":user" has been updated.', [
            'user' => $user->name,
        ]));

        return $this->redirectToList();
    }

    /**
     * Update the user profile.
     *
     * @param UserRequest $request
     * @param User        $user
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(UserRequest $request, UpdateUserService $updateUser)
    {
        $user = auth_admin()->user();
        $updateUser->profile($user, $request->getUserDto());

        toast(__('Your profile has been updated.'));

        return redirect()->route('admin.user.profile');
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
