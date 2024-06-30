<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminUserService;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;

class UserController extends Controller
{
    protected $userService;

    public function __construct(AdminUserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        (object) $users = $this->userService->getUsers(10);
        return view('admin.main.user.index', compact('users'));
    }


    public function create()
    {
        (array) $roles = $this->userService->getRoles();
        (array) $genders = $this->userService->getGenders();
        return view('admin.main.user.create', compact('roles', 'genders'));
    }

    /**
     * Store a newly created user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        (array) $data = $request->validated();
        $this->userService->createUser($data);
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        (object) $user =  $this->userService->getUserById($id);
        return view('admin.main.user.show', compact('user'));
    }

    /**
     * Show the form for editing the user.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        (object) $user = $this->userService->getUserById($id);
        (array) $roles = $this->userService->getRoles();
        return view('admin.main.user.edit', compact('user', 'roles'));
    }

    /**
     * User update.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        (array) $data = $request->validated();
        $this->userService->updateUser($data, $id);
        return redirect()->route('admin.user.edit', $id);
    }

    /**
     * Remove the user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->userService->destroy($id);
        return response()->json([
            'success' => true,
            'message' => "Пользователь успешно удален",
        ]);
    }

    /**
     * Func for chenge activity of user
     *
     * @param mixed $id
     * 
     * @return \Illuminate\Http\Response
     * 
     */
    public function toggleActivity($id)
    {
        $response = $this->userService->toggleActivity($id);

        return response()->json($response, 200);
    }
}
