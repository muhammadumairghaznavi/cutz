<?php

namespace App\Http\Controllers\Dashboard;

use App\Events\OrderNotification;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Victorybiz\GeoIPLocation\GeoIPLocation;

class UserController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_users'])->only('index');
        $this->middleware(['permission:create_users'])->only('create');
        $this->middleware(['permission:update_users'])->only('edit');
        $this->middleware(['permission:delete_users'])->only('destroy');
    } //end of constructor
    public function index_permissions(Request $request)
    {
        $permissions = Permission::latest()->get();
        return view('dashboard.users.permissions.index', compact('permissions'));
    } //end of index_permissions
    public function create_permissions()
    {
        return view('dashboard.users.permissions.create');
    } //end of create_permissions
    public function store_permissions(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions',
        ]);
        $request_data = $request->except(['']);


        $patterns = ['delete_', 'create_', 'read_', 'update_'];


        for ($i = 0; $i <  count($patterns); $i++) {
            $permission =  Permission::create(['name' => $patterns[$i] . $request->name, 'display_name' => $patterns[$i] . $request->name, 'description' => $patterns[$i] . $request->name]);
            DB::table('permission_role')->insert(['permission_id' => $permission->id, 'role_id' => 1]);
        }

        session()->flash('success', __('site.added_successfully'));
        return redirect()->back();
    } //end of store_permissions
    public function edit_permissions($id)
    {
        $permission = Permission::find($id);
        return view('dashboard.users.permissions.edit', compact('permission'));
    } //end of edit_permissions

    public function destroy_permissions($id)
    {
        $permission = Permission::find($id);
        $permission->delete();

        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->back();
    } //end of destroy_permissions
    public function update_permissions(Request $request, Permission $id)
    {
        $request->validate([
            'name' =>   ['required', Rule::unique('permissions')->ignore($id),],
        ]);
        $request_data = $request->except(['']);
        $id->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->back();
    } //end of update_permissions
    public function index(Request $request)
    {

        $geoip = new GeoIPLocation();

        // dd($geoip->getIP(), $geoip->getCountryCode());

        if ($geoip->getCountryCode() == 'NG') {
            //  dd('NG');
        }

        $users = User::whereRoleIs('admin')->where(function ($q) use ($request) {
            return $q->when($request->search, function ($query) use ($request) {
                return $query->where('first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('last_name', 'like', '%' . $request->search . '%');
            });
        })->latest()->get();
        return view('dashboard.users.index', compact('users'));
    } //end of index
    public
    function create()
    {
        $roles = Role::get();

        return view('dashboard.users.create', compact('roles'));
    } //end of create
    public function store(Request $request)
    {

        $request->validate([
            // 'role' => 'required|in:admin',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required', 'string', 'email', 'unique:users'],
            'image' => 'image',
            'password' => 'required|confirmed',
            // 'permissions' => 'required|min:1'
        ]);

        $request_data = $request->except(['password', 'password_confirmation', 'permissions', 'image']);
        $request_data['password'] = bcrypt($request->password);

        if ($request->image) {
            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/user_images/' . $request->image->hashName()));
            $request_data['image'] = $request->image->hashName();
        } //end of if

        $user = User::create($request_data);
        $user->attachRoles([$request->role_id]);

        // $user->syncPermissions($request->permissions);

        session()->flash('success', __('site.added_successfully'));

        return redirect()->route('dashboard.users.index');
    } //end of store

    public function edit(User $user)
    {
        $roles = Role::get();

        return view('dashboard.users.edit', compact('user', 'roles'));
    } //end of user

    public function edit_profile(User $user)
    {
        $roles = Role::get();
        return view('dashboard.users.edit_profile', compact('user'));
    } //end of user

    // update profile(normal user or admin ) or update the users(by the admin )
    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            // 'aboutUser' => 'nullable',
            'email' => ['required', Rule::unique('users')->ignore($user->id)],
            'image' => 'image',
            // 'permissions' => 'array',
            'password' => 'nullable|confirmed',

        ]);

        $request_data = $request->except(['permissions', 'image', 'password', 'password_confirmation']);

        if ($request->password) {
            $request_data['password'] = bcrypt($request->password);
        }
        if ($request->image) {

            if ($user->image != 'default.png') {

                Storage::disk('public_uploads')->delete('user_images/' . $user->image);
            } //end of inner if

            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/user_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        } //end of external if

        $user->update($request_data);
        $user->syncRoles([$request->role_id]);

        // if($request->permissions){
        //     $user->syncPermissions($request->permissions);
        // }
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.users.index');
    } //end of update

    public function destroy(User $user)
    {
        if (!$user) {
            return redirect()->back();
        }

        if ($user->image != 'default.png') {
            Storage::disk('public_uploads')->delete('user_images/' . $user->image);
        } //end of if

        $user->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.users.index');
    } //end of destroy

}//end of controller
