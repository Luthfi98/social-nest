<div class="btn-group">
    <a href="{{ route('cms.menus.edit', $menu->id) }}" class="btn btn-sm btn-warning">
        <i class="fas fa-edit"></i>
    </a>
    <button type="button" class="btn btn-sm btn-danger delete-menu" data-id="{{ $menu->id }}">
        <i class="fas fa-trash"></i>
    </button>
</div> 