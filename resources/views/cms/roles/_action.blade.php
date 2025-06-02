<div class="btn-group">
    <a href="{{ route('cms.roles.edit', $role->id) }}" class="btn btn-sm btn-warning">
        <i class="fas fa-edit"></i>
    </a>
    <button type="button" class="btn btn-sm btn-danger delete-role" data-id="{{ $role->id }}">
        <i class="fas fa-trash"></i>
    </button>
</div> 