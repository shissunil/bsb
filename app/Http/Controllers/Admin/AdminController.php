<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Models\Permission;
use App\Models\User;
use App\Models\Chat;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $admin = User::where('id', Auth::id())->first();
        if ($admin->role_id == '1')
        {
            $this->insertPermissions();
        }
        return view('admin.dashboard');
    }
    public function sub_admins()
    {
        $sub_admins = User::where('id', '!=', Auth::id())->whereIn('role_id',[2,5])->orderBy('id', 'DESC')->get();
        return view('admin.sub_admins.index', compact('sub_admins'));
    }

    public function create()
    {
        $permissions = Permission::groupBy('controller')
            ->select('controller')
            ->selectRaw('GROUP_CONCAT(method) as route_methods')
            ->selectRaw('GROUP_CONCAT(name) as route_names')
            ->selectRaw('GROUP_CONCAT(id) as pids')
            // ->orderBy('id', 'ASC')
            ->get();
        // $roles = Role::all();
        return view('admin.sub_admins.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        $permissions = $request->permissions;

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->status = $request->status ?? 0;
        $user->role_id = $request->role_id;
        // $user->token = '';
        // $user->email_verified_at = '';
        // $user->is_verified = 0;
        // $user->remember_token = '';
        $user->save();

        // atache all permissions to sub admin 
        if ($permissions) {
            //get already attach Ids
            $attachedIds = $user->permissions()->whereIn('permission_id', $permissions)->pluck('permission_id')->toArray();
            //Remove the attached IDs from the request array
            $newIds = array_diff($permissions, $attachedIds);
            // atache all permissions to admin.
            $user->permissions()->attach($newIds);
        }

        return redirect()->route('admin.sub_admins.index')->with('success', 'Sub admin added successfully.');
    }

    public function edit($id)
    {
        $sub_admin = User::findOrFail($id);
        $sub_admin_permissions = ($sub_admin->permissions)->pluck('id')->toArray();
        $permissions = Permission::groupBy('controller')
            ->select('controller')
            ->selectRaw('GROUP_CONCAT(method) as route_methods')
            ->selectRaw('GROUP_CONCAT(name) as route_names')
            ->selectRaw('GROUP_CONCAT(id) as pids')
            // ->orderBy('id', 'ASC')
            ->get();

        // $roles = Role::all();
        return view('admin.sub_admins.edit', compact('sub_admin','permissions','sub_admin_permissions'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            // 'password' => 'required',
        ]);

        if ($request->password != '') {
            //if new password updated
            if (!Hash::check($request->password, $user->password)) {
                $user->password = bcrypt($request->password);
            }
        }

        $permissions = $request->permissions;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->status = $request->status ?? 0;
        $user->role_id = $request->role_id;
        // $user->password = bcrypt($request->password);
        // $user->token = '';
        // $user->email_verified_at = '';
        // $user->is_verified = 0;
        // $user->remember_token = '';
        $user->save();

        // atache all permissions to sub admin 
        if ($permissions) {
            //delete old permisssions
            $deletedOldPermisssions = ($user->permissions()->detach());
            //get already attach Ids
            $attachedIds = $user->permissions()->whereIn('permission_id', $permissions)->pluck('permission_id')->toArray();
            //Remove the attached IDs from the request array
            $newIds = array_diff($permissions, $attachedIds);
            // atache all permissions to admin.
            $user->permissions()->attach($newIds);
        }

        return redirect()->route('admin.sub_admins.index')->with('success', 'Sub admin updated successfully.');
    }


    public function insertPermissions()
    {
        $notIncludedRoutes = [
            'admin.login', 'admin.login.submit', 'admin.forgot-password', 'admin.forgot-password.submit', 'admin.reset-password.submit', 'admin.reset-password', 'admin.logout', 'admin.profile', 'admin.profile.update', 'admin.change-password', 'admin.dashboard', 'admin.get_city', 'admin.get_pincode'
        ];

        $routeList = Route::getRoutes()->getRoutesByName();

        $permission_ids = []; // an empty array of stored permission IDs
        // iterate though all routes
        foreach ($routeList as $key => $route) {

            if (strpos($route->getName(), 'admin.') !== false) {
                if (!in_array($route->getName(), $notIncludedRoutes)) {

                    $middleware = $route->middleware();

                    if(in_array("role",$middleware)){

                        // get route action
                        $action = $route->getActionname();
                        // separating controller and method
                        $_action = explode('@', $action);

                        $controller = $_action[0];
                        $method = end($_action);
                        $routeName = $route->getName();
                        // dd($routeName);

                        // check if this permission is already exists
                        $permission_check = Permission::where(
                            ['controller' => $controller, 'method' => $method]
                        )->first();
                        if (!$permission_check) {
                            $permission = new Permission;
                            $permission->controller = $controller;
                            $permission->name = $routeName;
                            $permission->controller = $controller;
                            $permission->method = $method;
                            $permission->save();
                            // add stored permission id in array
                            $permission_ids[] = $permission->id;
                        }

                    }
                }
            }
        }

        if ($permission_ids) {
            // find admin.
            $user = User::where('id', Auth::id())->first();
            //get already attach Ids
            $attachedIds = $user->permissions()->whereIn('permission_id', $permission_ids)->pluck('permission_id')->toArray();
            //Remove the attached IDs from the request array
            $newIds = array_diff($permission_ids, $attachedIds);
            // atache all permissions to admin.
            $user->permissions()->attach($newIds);
        } else {
            $permission_ids = Permission::pluck('id')->toArray();
            $user = User::where('id',Auth::id())->first();
            //get already attach Ids
            $attachedIds = $user->permissions()->whereIn('permission_id', $permission_ids)->pluck('permission_id')->toArray();
            //Remove the attached IDs from the request array
            $newIds = array_diff($permission_ids, $attachedIds);
            $user->permissions()->attach($newIds);
        }
    }
    public function submitChat(Request $request)
    {
        $message = $request->message ?? '';
        if ($message != '')
        {
            $chat = new Chat;
            $chat->chat_head_id = $request->chat_head_id; 
            $chat->order_id = $request->order_id; 
            $chat->sender_id = Auth::id(); 
            $chat->message = $request->message; 
            $chat->save();
        }
        $offset = $request->offset ?? 0;
        $chatList = Chat::where('deleted_at','')->where('order_id',$request->order_id)->get();
        return view('admin.orders.ajaxChat',compact('chatList'));
    }
}
