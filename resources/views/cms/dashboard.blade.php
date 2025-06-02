@extends('layouts.cms')

@section('content')
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3">
            <h1 class="h3">Dashboard Overview</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <button type="button" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-download me-1"></i> Export
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-print me-1"></i> Print
                    </button>
                </div>
            </div>
        </div>

        <!-- Dashboard Cards -->
        <div class="row g-3">
            <div class="col-md-3">
                <div class="card stat-card primary">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Total Users</h5>
                                <h2 class="card-text">1,234</h2>
                                <p class="card-text text-muted mb-0"><small>Last updated 3 mins ago</small></p>
                            </div>
                            <div class="rounded-circle bg-primary bg-opacity-10 p-2">
                                <i class="fas fa-users fa-lg text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card success">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Total Posts</h5>
                                <h2 class="card-text">567</h2>
                                <p class="card-text text-muted mb-0"><small>Last updated 3 mins ago</small></p>
                            </div>
                            <div class="rounded-circle bg-success bg-opacity-10 p-2">
                                <i class="fas fa-newspaper fa-lg text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card warning">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Comments</h5>
                                <h2 class="card-text">890</h2>
                                <p class="card-text text-muted mb-0"><small>Last updated 3 mins ago</small></p>
                            </div>
                            <div class="rounded-circle bg-warning bg-opacity-10 p-2">
                                <i class="fas fa-comments fa-lg text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card info">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">Active Users</h5>
                                <h2 class="card-text">123</h2>
                                <p class="card-text text-muted mb-0"><small>Last updated 3 mins ago</small></p>
                            </div>
                            <div class="rounded-circle bg-danger bg-opacity-10 p-2">
                                <i class="fas fa-user-check fa-lg text-danger"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="card mt-3">
            <div class="card-header bg-transparent">
                <h5 class="card-title mb-0">Recent Activity</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Activity</th>
                                <th>Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name=John+Doe&background=4e73df&color=fff" 
                                             class="rounded-circle me-2 avatar" alt="John Doe">
                                        John Doe
                                    </div>
                                </td>
                                <td>Created a new post</td>
                                <td>2 minutes ago</td>
                                <td><span class="badge bg-success">Completed</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name=Jane+Smith&background=1cc88a&color=fff" 
                                             class="rounded-circle me-2 avatar" alt="Jane Smith">
                                        Jane Smith
                                    </div>
                                </td>
                                <td>Updated profile</td>
                                <td>5 minutes ago</td>
                                <td><span class="badge bg-info">In Progress</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name=Mike+Johnson&background=f6c23e&color=fff" 
                                             class="rounded-circle me-2 avatar" alt="Mike Johnson">
                                        Mike Johnson
                                    </div>
                                </td>
                                <td>Commented on post</td>
                                <td>10 minutes ago</td>
                                <td><span class="badge bg-success">Completed</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection