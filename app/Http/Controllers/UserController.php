<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Services\UserService;
use App\Services\KotaService;
use App\Services\ProvinsiService;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

class UserController extends Controller
{

    protected UserService $userService;
    protected KotaService $kotaService;
    protected ProvinsiService $provinsiService;

    public function __construct()
    {
        $this->userService = new UserService();
        $this->kotaService = new KotaService();
        $this->provinsiService = new ProvinsiService();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);

        $users = $this->userService->getAllUsers(Auth::user()->id);

        return view('pages.users.viewAllUsers', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', User::class);
        $kotas = $this->kotaService->getAllKotas();
        $provinsis = $this->provinsiService->getAllProvinsis();
        return view('pages.users.createUser', compact(['kotas', 'provinsis']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $this->authorize('create', User::class);
        $result = $this->userService->createUser($request->validated());
        if($result){
            return redirect()->route('users.index')->with('success', 'User berhasil dibuat.');
        }
        else {
            return redirect()->route('users.index')->with('error', 'User gagal dibuat.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $user = $this->userService->getUserById($id);

        $this->authorize('view', $user);

        return view('pages.users.viewUserDetail', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = $this->userService->getUserById($id);
        $this->authorize('update', $user);
        $kotas = $this->kotaService->getAllKotas();
        $provinsis = $this->provinsiService->getAllProvinsis();
        return view('pages.users.editUser', compact(['user', 'kotas', 'provinsis']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $model = $this->userService->getUserById($id);
        $this->authorize('update', $model);
        $result = $this->userService->updateUser($id, $request->validated());
        if($result){
            return redirect()->route('users.index')->with('success', 'User berhasil diubah.');
        }
        else {
            return redirect()->route('users.index')->with('error', 'User gagal diubah.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = $this->userService->getUserById($id);
        $this->authorize('delete', $user);
        $result = $this->userService->deleteUser($id);
        if($result){
            return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
        }
        else {
            return redirect()->route('users.index')->with('error', 'User gaga dihapus.');
        }
    }
}
