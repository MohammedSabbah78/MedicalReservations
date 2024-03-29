<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\City;
use App\Models\User;
use App\Notifications\NewUserNotification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\Environment\Console;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::withCount('permissions')->with(['city'])->get();
        return response()->view('cms.users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cities = City::where('active', '=', true)->get();
        return response()->view('cms.users.create', ['cities' => $cities]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator($request->all(), [
            'city_id' => 'required|numeric|exists:cities,id',
            'gender' => 'required|string|in:M,F',
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            'image' => 'required|image|max:2048|mimes:jpg,png',
        ]);


        if (!$validator->fails()) {
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->city_id = $request->input('city_id');
            $user->gender = $request->input('gender');
            $user->password = Hash::make('password');

            if ($request->hasFile('image')) {

                $imageName = time() . "_user_image" . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->storePubliclyAs('images', $imageName);
                $user->image = 'images/' . $imageName;
            }

            $isSaved = $user->save();
            if ($isSaved) {


                $admin = Admin::whereHas('roles', function ($query) {

                    $query->where('name', '=', 'Super-Admin');
                })->get();


                Notification::send($admin, new NewUserNotification($user));

                // $admin = Admin::first();
                // $admin->notify(new NewUserNotification($user));
            }
            return response()->json(
                ['message' => $isSaved ? 'Created' : 'Failed'],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {

            return response()->json(
                ["message" => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        $cities = City::where('active', '=', true)->get();
        return response()->view('cms.users.update', ['cities' => $cities, 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        $validator = Validator($request->all(), [
            'city_id' => 'required|numeric|exists:cities,id',
            'gender' => 'required|string|in:M,F',
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'image' => 'nullable|image|max:2048|mimes:jpg,png',

        ]);


        if (!$validator->fails()) {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->city_id = $request->input('city_id');
            $user->gender = $request->input('gender');

            if ($request->hasFile('image')) {
                Storage::delete($user->image);

                $imageName = time() . "_user_image" . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->storePubliclyAs('images', $imageName);
                $user->image = 'images/' . $imageName;
            }
            $isSaved = $user->save();
            return response()->json(
                ['message' => $isSaved ? 'Updated' : 'Failed'],
                $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(
                ["message" => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        $deleted = $user->delete();
        if ($deleted) {

            Storage::delete($user->image);
        }
        return response()->json(
            ['message' => $deleted ? 'Deleted!' : 'Failed'],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }

    /**
     * Show the form for editing the specified resource permssions.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function editUserPermission(Request $request, User $user)
    {

        $permissions = Permission::where('guard_name', '=', 'user')->orWhere('guard_name', '=', 'user-api')->get();
        $userPermissions = $user->permissions;


        foreach ($permissions as $permission) {
            $permission->setAttribute('assigned', false);

            foreach ($userPermissions as $userPermission) {
                if ($userPermission->id == $permission->id) {
                    $permission->setAttribute('assigned', true);
                }
            }
        }


        return response()->view('cms.users.user-permissions', ['users' => $user, 'permissions' => $permissions]);
    }
    /**
     * Update the specified resource permissions in storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateUserPermission(Request $request, User $user)
    {
        $validator = Validator($request->all(), [
            'permission_id' => 'required|numeric|exists:permissions,id',
        ]);
        if (!$validator->fails()) {

            $permission = Permission::findOrFail($request->input('permission_id'));
            $user->hasPermissionTo($permission)
                ? $user->revokePermissionTo($permission)
                : $user->givePermissionTo($permission);

            return response()->json(
                ["message" => "Permissions Updated Successfully"],
                Response::HTTP_OK
            );
        } else {
            return response()->json(
                ["message" => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
