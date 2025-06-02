<div class="btn-group">
    <a href="{{ route('cms.users.edit', $user->id) }}" class="btn btn-sm btn-warning">
        <i class="fas fa-edit"></i>
    </a>
    <button type="button" class="btn btn-sm btn-danger delete-user" data-id="{{ $user->id }}">
        <i class="fas fa-trash"></i>
    </button>
</div> 