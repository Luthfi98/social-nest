<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\RoleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $roles = RoleModel::query();
            
            return DataTables::of($roles)
                ->addColumn('action', function ($role) {
                    return view('cms.roles._action', compact('role'));
                })
                ->addColumn('status_badge', function ($role) {
                    return view('cms.roles._status_badge', compact('role'));
                })
                ->rawColumns(['action', 'status_badge'])
                ->make(true);
        }

        return view('cms.roles.index', [
            'title' => __('Roles Management')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cms.roles.create', [
            'title' => __('Create New Role')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive'
        ]);

        $role = RoleModel::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status
        ]);

        return redirect()
            ->route('cms.roles.index')
            ->with('success', __('Role created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = RoleModel::findOrFail($id);
        return view('cms.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = RoleModel::findOrFail($id);
        return view('cms.roles.edit', [
            'title' => __('Edit Role'),
            'role' => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = RoleModel::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive'
        ]);

        $role->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status
        ]);

        return redirect()
            ->route('cms.roles.index')
            ->with('success', __('Role updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = RoleModel::findOrFail($id);
        $role->delete();

        return response()->json([
            'success' => true,
            'message' => __('Role deleted successfully')
        ]);
    }
}
