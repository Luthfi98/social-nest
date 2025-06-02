@extends('layouts.cms')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">{{ $title }}</h5>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb small mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('cms.dashboard') }}" class="text-decoration-none">
                    <i class="fas fa-home"></i> {{ __('Dashboard') }}
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('cms.menus.index') }}" class="text-decoration-none">
                    <i class="fas fa-list-ul"></i> {{ __('Menus') }}
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <i class="fas fa-sort"></i> {{ __('Sorting') }}
            </li>
        </ol>
    </nav>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- Public Menus Column -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-primary text-white py-2">
                                    <h6 class="card-title mb-0">Public Menus</h6>
                                </div>
                                <div class="card-body p-2">
                                    <ul id="public-menu-list" class="list-group sortable-menu">
                                        @foreach($publicMenus as $menu)
                                            <li class="list-group-item py-2" data-id="{{ $menu->id }}">
                                                <i class="fas fa-grip-vertical handle"></i>
                                                {{ $menu->name }}
                                                @if($menu->children->count() > 0)
                                                    <ul class="list-group mt-2 ms-4">
                                                        @foreach($menu->children->sortBy('order') as $child)
                                                            <li class="list-group-item py-2" data-id="{{ $child->id }}">
                                                                <i class="fas fa-grip-vertical handle"></i>
                                                                {{ $child->name }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Non-Public Menus Column -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-secondary text-white py-2">
                                    <h6 class="card-title mb-0">Non-Public Menus</h6>
                                </div>
                                <div class="card-body p-2">
                                    <ul id="non-public-menu-list" class="list-group sortable-menu">
                                        @foreach($nonPublicMenus as $menu)
                                            <li class="list-group-item py-2" data-id="{{ $menu->id }}">
                                                <i class="fas fa-grip-vertical handle"></i>
                                                {{ $menu->name }}
                                                @if($menu->children->count() > 0)
                                                    <ul class="list-group mt-2 ms-4">
                                                        @foreach($menu->children->sortBy('order') as $child)
                                                            <li class="list-group-item py-2" data-id="{{ $child->id }}">
                                                                <i class="fas fa-grip-vertical handle"></i>
                                                                {{ $child->name }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-sm btn-primary" id="save-sorting">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
    .sortable-menu {
        min-height: 50px;
    }
    .sortable-menu .list-group-item {
        margin-bottom: 3px;
        font-size: 0.9rem;
        transition: background-color 0.2s ease;
        position: relative;
        cursor: default;
    }
    .sortable-menu ul {
        list-style: none;
        padding-left: 0;
        transition: all 0.2s ease;
    }
    .sortable-menu ul .list-group-item {
        background-color: #f8f9fa;
        border-left: 3px solid #6c757d;
        padding-left: 1.5rem;
    }
    .handle {
        cursor: move;
        margin-right: 8px;
        color: #6c757d;
        transition: color 0.2s ease;
        display: inline-block;
        width: 20px;
        text-align: center;
    }
    .list-group-item:hover .handle {
        color: #495057;
    }
    .ui-sortable-helper {
        background: #fff !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        z-index: 1000;
        transform: rotate(1deg) scale(1.01);
        transition: none !important;
    }
    .ui-sortable-placeholder {
        visibility: visible !important;
        background: #f8f9fa !important;
        border: 2px dashed #6c757d !important;
        margin: 3px 0;
        transition: none !important;
    }
    .card {
        margin-bottom: 1rem;
    }
    .card-header {
        padding: 0.5rem 1rem;
    }
    .list-group-item:hover {
        background-color: #e9ecef;
    }
    .list-group-item.ui-sortable-helper {
        transform: rotate(1deg) scale(1.01);
    }
    .sortable-menu ul .list-group-item:hover {
        background-color: #e9ecef;
        border-left-color: #495057;
    }
    .ui-sortable-helper .handle {
        color: #495057;
    }
    /* Disable text selection during drag */
    .sortable-menu * {
        user-select: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
    }
    /* Style for menu items that can receive submenus */
    .can-drop-submenu {
        background-color: #e3f2fd !important;
        border-left: 3px solid #2196f3 !important;
    }
    .can-drop-submenu::after {
        content: 'Drop to create submenu';
        position: absolute;
        right: 10px;
        font-size: 0.8rem;
        color: #2196f3;
        opacity: 0.8;
    }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize sortable for both lists with nested sorting
    $(".sortable-menu").sortable({
        handle: ".handle",
        connectWith: ".sortable-menu, .sortable-menu ul",
        placeholder: "ui-state-highlight",
        forcePlaceholderSize: true,
        items: "> li",
        tolerance: "pointer",
        helper: "clone",
        opacity: 0.9,
        revert: 100,
        scroll: true,
        scrollSensitivity: 30,
        scrollSpeed: 10,
        start: function(e, ui) {
            ui.placeholder.height(ui.item.height());
            ui.item.addClass('dragging');
        },
        stop: function(e, ui) {
            ui.item.removeClass('dragging');
        },
        receive: function(e, ui) {
            const $item = ui.item;
            const $target = $(this);
            
            if ($target.is('ul')) {
                const $children = $item.find('> ul');
                if ($children.length) {
                    $children.detach().appendTo($item);
                }
            }
        },
        over: function(e, ui) {
            const $target = $(e.target);
            if ($target.is('li') && !$target.find('> ul').length) {
                $target.addClass('can-drop-submenu');
            }
        },
        out: function(e, ui) {
            $(e.target).removeClass('can-drop-submenu');
        }
    });

    // Initialize sortable for child lists with cross-list movement
    $(".sortable-menu ul").sortable({
        handle: ".handle",
        connectWith: ".sortable-menu ul, .sortable-menu",
        placeholder: "ui-state-highlight",
        forcePlaceholderSize: true,
        tolerance: "pointer",
        helper: "clone",
        opacity: 0.9,
        revert: 100,
        scroll: true,
        scrollSensitivity: 30,
        scrollSpeed: 10,
        start: function(e, ui) {
            ui.placeholder.height(ui.item.height());
            ui.item.addClass('dragging');
        },
        stop: function(e, ui) {
            ui.item.removeClass('dragging');
        },
        receive: function(e, ui) {
            const $item = ui.item;
            const $target = $(this);
            
            if ($target.is('.sortable-menu')) {
                const $children = $item.find('> ul');
                if ($children.length) {
                    $children.detach().appendTo($item);
                }
            }
            else if ($target.is('ul')) {
                const $children = $item.find('> ul');
                if ($children.length) {
                    $children.detach().appendTo($item);
                }
            }
        }
    });

    // Handle dropping on main menu items
    $(".sortable-menu").on('drop', function(e, ui) {
        const $target = $(e.target);
        if ($target.is('li') && !$target.find('> ul').length) {
            const $item = ui.item;
            if (!$item.find('> ul').length) {
                $item.wrap('<ul class="list-group mt-2 ms-4"></ul>');
            }
        }
    });

    // Save sorting
    $('#save-sorting').click(function() {
        const getMenuStructure = function(container) {
            const menuIds = [];
            const parentMenus = {};

            container.children('li').each(function() {
                const $li = $(this);
                const menuId = $li.data('id');
                menuIds.push(menuId);

                // Get children
                $li.find('> ul > li').each(function() {
                    const childId = $(this).data('id');
                    parentMenus[childId] = menuId;
                });
            });

            return {
                menuIds: menuIds,
                parentMenus: parentMenus
            };
        };

        const publicStructure = getMenuStructure($('#public-menu-list'));
        const nonPublicStructure = getMenuStructure($('#non-public-menu-list'));

        // Prepare the data
        const data = {
            _token: '{{ csrf_token() }}',
            public_menus: publicStructure.menuIds.length > 0 ? publicStructure.menuIds : [],
            non_public_menus: nonPublicStructure.menuIds.length > 0 ? nonPublicStructure.menuIds : [],
            parent_menus: {
                ...publicStructure.parentMenus,
                ...nonPublicStructure.parentMenus
            }
        };

        // Remove empty parent_menus if no parent-child relationships exist
        if (Object.keys(data.parent_menus).length === 0) {
            delete data.parent_menus;
        }

        $.ajax({
            url: '{{ route("cms.menus.update-sorting") }}',
            method: 'POST',
            data: data,
            success: function(response) {
                toastr.success('Menu sorting updated successfully');
            },
            error: function(xhr) {
                toastr.error(xhr.responseJSON?.message || 'Failed to update menu sorting');
            }
        });
    });
});
</script>
@endpush
@endsection 