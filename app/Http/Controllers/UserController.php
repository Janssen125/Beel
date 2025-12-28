<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\User_Pusat;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = [];
        $pusat_id = User_Pusat::where('user_id', Auth::user()->id)->first()->pusat_id;

        switch(Auth::user()->role){
            case 'superadmin':
                $users = User::orderBy('created_at', 'desc')->get();
                break;
            case 'admin':
                $users = User::where('role', 'staff')->orderBy('created_at', 'desc')->whereHas('userPusats', function($query) use ($pusat_id) {
                    $query->where('pusat_id', $pusat_id);
                })->get();
                break;
            default:
                abort(403);
        }

        return view('pages.users.viewAllUsers', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        switch(Auth::user()->role){
            case 'superadmin':
                break;
            case 'admin':
                break;
            default:
                abort(403);
        }

        $user = User::findOrFail($id);

        $data_pusat_id = User_Pusat::where('user_id', $user->id)->first()->pusat_id;
        $pusat_id = User_Pusat::where('user_id', Auth::user()->id)->first()->pusat_id;

        if(Auth::user()->role == 'admin'){
            if($user->role != 'staff' || $data_pusat_id != $pusat_id){
                abort(403);
            }
        }

        return view('pages.users.viewUserDetail', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
