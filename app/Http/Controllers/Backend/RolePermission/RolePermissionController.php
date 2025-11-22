<?php

namespace App\Http\Controllers\Backend\RolePermission;

use App\Http\Controllers\Controller;
use App\Models\User;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    public function createUser()
    {
        return view('backend.rolePermission.creatUser');
    }
    public function userList()
    {
        $userInfo = User::latest()->get();
        return view('backend.rolePermission.userList', compact('userInfo'));
    }


    // user store

    public function userStore(Request $request)
    {
        $request->validate([
            'user_image' => 'required|mimes:jpeg,png,jpg,svg|max:2048',
            'user_name' => 'required',
            'user_email' => 'required',
            'user_pass' => 'required|min:6',
        ]);

        // valid pass
        if ($request->user_pass != $request->user_confirm_password) {
            return back()->with('error', 'Confirm Password does not match!');
        }

        // image upload

        $userInfo = new User();
        if ($request->hasFile('user_image')) {
            $image = $request->file('user_image');
            $uniName = 'user-image-' . time() . '-' . $request->user_image->getClientOriginalName();
            $image->storeAs('profileImages/', $uniName, 'public');
            $userInfo->profile_image = $uniName;
        }


        $userInfo->name = $request->user_name;
        $userInfo->email = $request->user_email;
        $userInfo->password = Hash::make($request->user_pass);
        $userInfo->save();
        return back();




    }
    // user delete
    public function userdelete($id)
    {
        User::find($id)->delete();
        return back();
    }

    //   user edit
    public function useredit($id)
    {
        $userEdit = User::find($id);
        return view('backend.rolePermission.editUser', compact('userEdit'));
    }

    // user update

    public function userUpdate(Request $request, $id)
    {
        $request->validate([

            'user_name' => 'required',
            'user_email' => 'required',
            'user_pass' => 'required|min:6',
        ]);

        // valid pass
        if ($request->user_pass != $request->user_confirm_password) {
            return back()->with('error', 'Confirm Password does not match!');
        }

        // image upload

        $userInfo = User::find($id);
        if ($request->hasFile('user_image')) {
            $image = $request->file('user_image');
            $uniName = 'user-image-' . time() . '-' . $request->user_image->getClientOriginalName();
            $image->storeAs('profileImages/', $uniName, 'public');
            $userInfo->profile_image = $uniName;
        }


        $userInfo->name = $request->user_name;
        $userInfo->email = $request->user_email;
        $userInfo->password = Hash::make($request->user_pass);
        $userInfo->save();
        return back();




    }

    // role create
    public function createRole()
    {
        return view('backend.rolePermission.createRole');
    }
    // role store
    public function createRoleStore(Request $request)
    {
        $request->validate([
            'role_name' => 'required|unique:roles,name',
        ]);
        // code for storing role
        $roles = new Role();
        $roles->name = $request->role_name;
        $roles->guard_name = 'web';
        $roles->save();
        return back();

    }

    // role list
    public function roleList($id)
    {
        $user = User::find($id);
        $roles = Role::latest()->get();
        return view('backend.rolePermission.roleList', compact('roles', 'user'));
    }




    // Role Store
    public function roleListStore(Request $request)
    {

        $user = User::find($request->user_id);
        $user->syncRoles($request->roles);
        return back();
    }

    // all roles 
    public function allRoles()
    {
        $roles = Role::latest()->get();
        return view('backend.rolePermission.allRoles', compact('roles'));
    }

    // permissions
    public function permissions($id)
    {
        $role = Role::find($id);
        $permissions = Permission::latest()->get();
        return view('backend.rolePermission.permissions', compact('role', 'permissions'));
    }

    // permission store
    public function permissionsStore(Request $request)
    {
        $role = Role::find($request->role_name);
        $role->syncPermissions($request->permissions);  
        return back();
    }





}