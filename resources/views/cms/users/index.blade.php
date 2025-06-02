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
            <li class="breadcrumb-item active" aria-current="page">
                <i class="fas fa-users"></i> {{ __('Users') }}
            </li>
        </ol>
    </nav>
</div>
    <div class="card">
        <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Users List</h6>
            <a href="{{ route('cms.users.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus me-1"></i> {{ __('Create New Role') }}
            </a>
        </div>
    </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" id="users-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
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
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('cms.users.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'username', name: 'username'},
                {data: 'email', name: 'email'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
            order: [[0, 'desc']]
        });

        // Delete user
        $(document).on('click', '.delete-user', function() {
            let userId = $(this).data('id');
            
            if (confirm('Are you sure you want to delete this user?')) {
                $.ajax({
                    url: `/cms/users/${userId}`,
                    type: 'DELETE',
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('#users-table').DataTable().ajax.reload();
                        toastr.success('User deleted successfully');
                    },
                    error: function(xhr) {
                        toastr.error('Error deleting user');
                    }
                });
            }
        });
    });
</script>
@endpush