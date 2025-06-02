<?php

namespace App\Http\Controllers\Cms;

use App\Models\MenuModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $menus = MenuModel::query();
            
            return DataTables::of($menus)
                ->addColumn('action', function ($menu) {
                    return view('cms.menus._action', compact('menu'));
                })
                ->addColumn('status_badge', function ($menu) {
                    return view('cms.menus._status_badge', compact('menu'));
                })
                ->rawColumns(['action', 'status_badge'])
                ->make(true);
        }

        return view('cms.menus.index', [
            'title' => __('Menu Management')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => __('Create Menu'),
            'parents' => MenuModel::where('parent_id', null)->get(),
        ];

        return view('cms.menus.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:menus,slug',
            'route' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'parent_id' => 'nullable|exists:menus,id',
            'permissions' => 'nullable|array',
            'permissions.*' => 'string',
            'is_public' => 'boolean'
        ]);

        $menu = MenuModel::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'route' => $request->route,
            'icon' => $request->icon,
            'order' => $request->order ?? 0,
            'description' => $request->description,
            'status' => $request->status,
            'parent_id' => $request->parent_id,
            'permissions' => $request->permissions,
            'is_public' => $request->boolean('is_public')
        ]);

        return redirect()
            ->route('cms.menus.index')
            ->with('success', __('Menu created successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $menu = MenuModel::findOrFail($id);
        return view('cms.menus.show', [
            'title' => __('View Menu'),
            'menu' => $menu
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $menu = MenuModel::findOrFail($id);
        $parents = MenuModel::where('parent_id', null)
            ->where('id', '!=', $id)
            ->get();

        return view('cms.menus.edit', [
            'title' => __('Edit Menu'),
            'menu' => $menu,
            'parents' => $parents
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            \DB::beginTransaction();

            $menu = MenuModel::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255',
                'slug' => 'required|string|max:255|unique:menus,slug,' . $id,
                'route' => 'nullable|string|max:255',
                'icon' => 'nullable|string|max:255',
                'order' => 'nullable|integer',
                'description' => 'nullable|string',
                'status' => 'required|in:active,inactive',
                'parent_id' => 'nullable|exists:menus,id',
                'permissions' => 'nullable|array',
                'permissions.*' => 'string',
                'is_public' => 'boolean'
            ]);

            // Check if parent_id is not the same as the current menu id
            if ($request->parent_id == $id) {
                throw new \Exception(__('A menu cannot be its own parent.'));
            }

            // Check if parent_id is not a child of the current menu
            if ($request->parent_id) {
                $parent = MenuModel::find($request->parent_id);
                if ($parent->isDescendantOf($menu)) {
                    throw new \Exception(__('Cannot set a child menu as parent.'));
                }
            }
            
            $menu->update([
                'name' => $request->name,
                'slug' => $request->slug,
                'route' => $request->route,
                'icon' => $request->icon,
                'order' => $request->order ?? 0,
                'description' => $request->description,
                'status' => $request->status,
                'parent_id' => $request->parent_id,
                'permissions' => $request->permissions,
                'is_public' => $request->boolean('is_public')
            ]);

            \DB::commit();

            return redirect()
                ->route('cms.menus.index')
                ->with('success', __('Menu updated successfully.'));
        } catch (\Exception $e) {
            \DB::rollBack();
            
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menu = MenuModel::findOrFail($id);
        
        // Check if menu has children
        if ($menu->children()->exists()) {
            return response()->json([
                'message' => __('Cannot delete menu with children. Please delete children first.')
            ], 422);
        }

        $menu->delete();

        return response()->json([
            'message' => __('Menu deleted successfully.')
        ]);
    }

    /**
     * Show the menu sorting page.
     */
    public function sorting()
    {
        $publicMenus = MenuModel::where('is_public', true)
            ->where('parent_id', null)
            ->orderBy('order')
            ->get();

        $nonPublicMenus = MenuModel::where('is_public', false)
            ->where('parent_id', null)
            ->orderBy('order')
            ->get();

        return view('cms.menus.sorting', [
            'title' => __('Menu Sorting'),
            'publicMenus' => $publicMenus,
            'nonPublicMenus' => $nonPublicMenus
        ]);
    }

    /**
     * Update menu sorting.
     */
    public function updateSorting(Request $request)
    {
        $request->validate([
            'public_menus' => 'nullable|array',
            'public_menus.*' => 'exists:menus,id',
            'non_public_menus' => 'nullable|array',
            'non_public_menus.*' => 'exists:menus,id',
            'parent_menus' => 'nullable|array',
            'parent_menus.*' => 'exists:menus,id'
        ]);

        try {
            \DB::beginTransaction();

            // Update public menus
            if ($request->has('public_menus') && is_array($request->public_menus)) {
                foreach ($request->public_menus as $order => $id) {
                    MenuModel::where('id', $id)->update([
                        'order' => $order,
                        'is_public' => true,
                        'parent_id' => null
                    ]);
                }
            }

            // Update non-public menus
            if ($request->has('non_public_menus') && is_array($request->non_public_menus)) {
                foreach ($request->non_public_menus as $order => $id) {
                    MenuModel::where('id', $id)->update([
                        'order' => $order,
                        'is_public' => false,
                        'parent_id' => null
                    ]);
                }
            }

            // Update parent menus if provided
            if ($request->has('parent_menus') && is_array($request->parent_menus)) {
                $sort  = 0;
                foreach ($request->parent_menus as $childId => $parentId) {
                    // Skip if parent_id is null or empty
                    if (empty($parentId)) {
                        continue;
                    }

                    // Check if parent_id is not the same as the child id
                    if ($childId == $parentId) {
                        continue;
                    }

                    // Check if parent_id is not a child of the current menu
                    $parent = MenuModel::find($parentId);
                    $child = MenuModel::find($childId);
                    
                    
                    if ($parent && $child && $parent->isDescendantOf($child)) {
                        continue;
                    }

                    MenuModel::where('id', $childId)->update([
                        'parent_id' => $parentId,
                        'order' => $sort++
                    ]);
                }
            }

            \DB::commit();

            return response()->json([
                'message' => __('Menu sorting updated successfully.')
            ]);
        } catch (\Exception $e) {
            \DB::rollBack();
            
            return response()->json([
                'message' => __('Failed to update menu sorting: ') . $e->getMessage()
            ], 500);
        }
    }
}
