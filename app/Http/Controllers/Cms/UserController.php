<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\RoleModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $users = User::select(['id', 'name', 'email', 'created_at', 'username', 'status'])->latest();
            
            return DataTables::of($users)
                ->addColumn('action', function($user) {
                    return view('cms.users._action', compact('user'));
                })
                ->editColumn('created_at', function($user) {
                    return $user->created_at->format('d M Y H:i');
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $data = [
            'title' => __('Management Users'),
        ];
        return view('cms.users.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => __('Create User'),
            'roles' => RoleModel::where('status', 'active')->get(),
        ];
        return view('cms.users.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validate([
                'role_id' => 'nullable|exists:roles,id',
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:50|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'bio' => 'nullable|string|max:255',
                'status' => 'required|in:active,inactive',
            ]);

            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                
                // Create folder if not exists
                $path = 'public/avatars';
                if (!file_exists(public_path($path))) {
                    mkdir(public_path($path), 0777, true);
                }

                $path = $file->move(public_path($path), $file->getClientOriginalName());
                $validated['avatar'] = 'avatars/' . $file->getClientOriginalName();
            }

            $validated['password'] = Hash::make($validated['password']);

            User::create($validated);

            DB::commit();
            return redirect()->route('cms.users.index')
                ->with('success', __('User created successfully.'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', __('Failed to create user: ') . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $data = [
            'title' => __('Edit User'),
            'user' => $user,
            'roles' => RoleModel::where('status', 'active')->get(),
        ];
        return view('cms.users.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);

            $validated = $request->validate([
                'role_id' => 'nullable|exists:roles,id',
                'name' => 'required|string|max:255',
                'username' => ['required', 'string', 'max:50', Rule::unique('users')->ignore($id)],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
                'password' => 'nullable|string|min:8',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'bio' => 'nullable|string|max:255',
                'status' => 'required|in:active,inactive',
            ]);

            if ($request->hasFile('avatar')) {
                $path = 'public/avatars';

                if ($user->avatar && file_exists(public_path($path))) {
                    unlink(public_path($user->avatar));
                }

                // Create folder if not exists
                if (!file_exists(public_path($path))) {
                    mkdir(public_path($path), 0777, true);
                }

                $path = $request->file('avatar')->move(public_path($path), $request->file('avatar')->getClientOriginalName());
                $validated['avatar'] = 'avatars/' . $request->file('avatar')->getClientOriginalName();
            }

            if (!empty($validated['password'])) {
                $validated['password'] = Hash::make($validated['password']);
            } else {
                unset($validated['password']);
            }

            $user->update($validated);

            DB::commit();
            return redirect()->route('cms.users.index')
                ->with('success', __('User updated successfully.'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', __('Failed to update user: ') . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

