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
            <li class="breadcrumb-item" aria-current="page">
                <i class="fas fa-user-tag"></i> {{ __('Roles') }}
            </li>
        </ol>
    </nav>
</div>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Roles List</h6>
            <a href="{{ route('cms.roles.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus me-1"></i> {{ __('Create New Role') }}
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" id="roles-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function() {
        $('#roles-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('cms.roles.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'description', name: 'description'},
                {data: 'status_badge', name: 'status'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
            order: [[0, 'desc']]
        });

        // Delete role
        $(document).on('click', '.delete-role', function() {
            let roleId = $(this).data('id');
            
            if (confirm('Are you sure you want to delete this role?')) {
                $.ajax({
                    url: `/cms/roles/${roleId}`,
                    type: 'DELETE',
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('#roles-table').DataTable().ajax.reload();
                        toastr.success('Role deleted successfully');
                    },
                    error: function(xhr) {
                        toastr.error('Error deleting role');
                    }
                });
            }
        });
    });
</script>
@endpush