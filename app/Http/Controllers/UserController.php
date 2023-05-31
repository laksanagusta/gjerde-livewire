<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Services\UserService;
use App\Models\Location;
use App\Models\User;
use Illuminate\Contracts\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        return view('users.index', [
            'users' => User::paginate(10)
        ]);
    }


    public function create(): View
    {
        return view('users.create');
    }

    public function store(UserRequest $request, UserService $userService)
    {
        $userService->create($request->all());
        return view('users.index');
    }

    public function show(string $id)
    {
        
    }

    public function edit(string $id, UserService $userService)
    {
        $user = $userService->findById($id);
        return view('users.edit', $user);
    }

    public function destroy(string $id)
    {
           
    }
}
