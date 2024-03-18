<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $isTrashedUser = (bool)$request->get('is-trashed-user');
        $users = $this->userService->getUsers($isTrashedUser);
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = new User();
        return view('user.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $this->userService->createOrUpdate($request->all());
            });
            session()->flash('success', 'User created successfully');
            return redirect(route('users.index'));
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        try {
            $user = $this->userService->show($user);
            return view('user.show', compact('user'));
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        try {
            $user = $this->userService->show($user);
            return view('user.edit', compact('user'));
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        try {
            DB::transaction(function () use ($request, $user) {
                $this->userService->createOrUpdate($request->all(), $user);
            });
            session()->flash('success', 'User updated successfully');
            return redirect(route('users.index'));
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            DB::transaction(function () use ($user) {
                $this->userService->destroy($user);
            });
            session()->flash('success', 'User deleted successfully');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
        return redirect(route('users.index'));
    }

    public function restore($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $this->userService->restore($id);
            });
            session()->flash('success', 'User restore successfully');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
        return redirect()->back();
    }

    public function destroyPermanently($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $user = User::withTrashed()->find($id);
                $this->userService->destroy($user,true);
            });
            session()->flash('success', 'User deleted permanently.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
        return redirect()->back();
    }
}
