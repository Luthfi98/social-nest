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
                <i class="fas fa-list-ul"></i> {{ __('Menus') }}
            </li>
        </ol>
    </nav>
</div>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Menus List</h6>
            <a href="{{ route('cms.menus.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus me-1"></i> {{ __('Create New Menu') }}
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" id="menus-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Route</th>
                        <th>Icon</th>
                        <th>Order</th>
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
        $('#menus-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('cms.menus.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'slug', name: 'slug'},
                {data: 'route', name: 'route'},
                {data: 'icon', name: 'icon'},
                {data: 'order', name: 'order'},
                {data: 'description', name: 'description'},
                {data: 'status_badge', name: 'status'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
            order: [[0, 'desc']]
        });

        // Delete menu
        $(document).on('click', '.delete-menu', function() {
            let menuId = $(this).data('id');
            
            if (confirm('Are you sure you want to delete this menu?')) {
                $.ajax({
                    url: `/cms/menus/${menuId}`,
                    type: 'DELETE',
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('#menus-table').DataTable().ajax.reload();
                        toastr.success('Menu deleted successfully');
                    },
                    error: function(xhr) {
                        toastr.error('Error deleting menu');
                    }
                });
            }
        });
    });
</script>
@endpush