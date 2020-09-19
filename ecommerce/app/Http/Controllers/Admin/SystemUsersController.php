<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SystemUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $systemUsers = Admin::orderBy('created_at', 'DESC')->where('email', '!=', 'Admin@test.com')->paginate(10);
        return view('admin.systemUsers.index', compact('systemUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all()->where('name', '!=', 'superAdmin');
        return view('admin.systemUsers.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        $user = Admin::create([
            'name' => $request->userName,
            'email' => $request->userEmail,
            'password' => Hash::make($request->userPassword)
        ]);

        foreach ($request->userRoles as $userRole) {
            $user->assignRole($userRole);
        }

        return redirect()->route('systemUsers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Admin::find($id);
        $roles = Role::all()->where('name', '!=', 'superAdmin');
        return view('admin.systemUsers.edit', compact(['user', 'roles']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Admin::find($id);
        $user->update([
            'name' => $request->userName,
            'email' => $request->userEmail,
            'password' => Hash::make($request->userPassword)
        ]);

        if ($user->roles->pluck('name') != null) {
            foreach ($user->roles->pluck('name') as $userRole) {
                $user->removeRole($userRole);
            }
        }

        if ($request->userRoles != null) {
            foreach ($request->userRoles as $userRole) {
                $user->assignRole($userRole);
            }
        }

        return redirect()->route('systemUsers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Admin::find($id);
        $user->delete();
        return redirect()->route('systemUsers.index');
    }
}
