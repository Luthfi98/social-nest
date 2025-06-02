@extends('layouts.landing')
@section('content')
<!-- Left Sidebar -->
<div class="sidebar left">
    <div class="sidebar-card">
        <div class="sidebar-item">
            <div class="sidebar-icon">
                <img src="https://via.placeholder.com/28" alt="Profile" class="rounded-circle">
            </div>
            <span>{{ Auth::user()->name }}</span>
        </div>
        <div class="sidebar-item">
            <div class="sidebar-icon">
                <i class="fas fa-user-friends text-primary"></i>
            </div>
            <span>Friends</span>
        </div>
        <div class="sidebar-item">
            <div class="sidebar-icon">
                <i class="fas fa-users text-primary"></i>
            </div>
            <span>Groups</span>
        </div>
    </div>

    <div class="sidebar-card">
        <h6 class="mb-3">Shortcuts</h6>
        <div class="sidebar-item">
            <div class="sidebar-icon">
                <i class="fas fa-store text-primary"></i>
            </div>
            <span>Marketplace</span>
        </div>
        <div class="sidebar-item">
            <div class="sidebar-icon">
                <i class="fas fa-tv text-primary"></i>
            </div>
            <span>Watch</span>
        </div>
        <div class="sidebar-item">
            <div class="sidebar-icon">
                <i class="fas fa-history text-primary"></i>
            </div>
            <span>Memories</span>
        </div>
        <div class="sidebar-item">
            <div class="sidebar-icon">
                <i class="fas fa-bookmark text-primary"></i>
            </div>
            <span>Saved</span>
        </div>
    </div>
</div>

<!-- Sidebar Toggle Button -->
<div class="sidebar-toggle">
    <i class="fas fa-chevron-left"></i>
</div>

<!-- Main Feed -->
<div class="feed-container">
    <div class="feed">
        <!-- Create Post -->
        <div class="create-post">
            <div class="d-flex align-items-center mb-3">
                <img src="https://via.placeholder.com/32" alt="Profile" class="rounded-circle me-2">
                <input type="text" class="post-input" placeholder="What's on your mind?">
            </div>
            <div class="post-actions d-flex justify-content-between">
                <div class="post-action-btn">
                    <i class="fas fa-images text-success"></i> Photo/Video
                </div>
                <div class="post-action-btn">
                    <i class="fas fa-smile text-warning"></i> Feeling/Activity
                </div>
            </div>
        </div>

        <!-- Sample Posts -->
        <div class="post">
            <div class="post-header">
                <img src="https://via.placeholder.com/32" alt="Profile" class="rounded-circle">
                <div class="post-info">
                    <h6>John Doe</h6>
                    <small class="text-muted">2 hours ago</small>
                </div>
            </div>
            <div class="post-content">
                <p>Just finished my morning workout! 💪 Starting the day right with some exercise and healthy breakfast. #FitnessGoals #HealthyLifestyle</p>
            </div>
            <img src="https://via.placeholder.com/600x400" alt="Post" class="img-fluid rounded mb-3">
            <div class="post-stats">
                <span><i class="fas fa-thumbs-up text-primary"></i> 245</span>
                <span class="ms-3"><i class="fas fa-comment"></i> 23 comments</span>
                <span class="ms-3"><i class="fas fa-share"></i> 5 shares</span>
            </div>
            <div class="post-actions-bar">
                <div class="post-action-btn">
                    <i class="far fa-thumbs-up"></i> Like
                </div>
                <div class="post-action-btn">
                    <i class="far fa-comment"></i> Comment
                </div>
                <div class="post-action-btn">
                    <i class="far fa-share-square"></i> Share
                </div>
            </div>
            <div class="post-comments">
                <div class="d-flex mb-2">
                    <img src="https://via.placeholder.com/28" alt="Profile" class="rounded-circle me-2">
                    <div class="flex-grow-1">
                        <div class="bg-light rounded p-2">
                            <strong class="small">Jane Smith</strong>
                            <p class="mb-0 small">Looking great! Keep up the good work! 💪</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <img src="https://via.placeholder.com/28" alt="Profile" class="rounded-circle me-2">
                    <input type="text" class="comment-input" placeholder="Write a comment...">
                </div>
            </div>
        </div>

        <div class="post">
            <div class="post-header">
                <img src="https://via.placeholder.com/32" alt="Profile" class="rounded-circle">
                <div class="post-info">
                    <h6>Sarah Johnson</h6>
                    <small class="text-muted">5 hours ago</small>
                </div>
            </div>
            <div class="post-content">
                <p>Excited to share my latest photography project! Nature has so much beauty to offer. 🌿 #Photography #Nature</p>
            </div>
            <img src="https://via.placeholder.com/600x400" alt="Post" class="img-fluid rounded mb-3">
            <div class="post-stats">
                <span><i class="fas fa-thumbs-up text-primary"></i> 189</span>
                <span class="ms-3"><i class="fas fa-comment"></i> 15 comments</span>
                <span class="ms-3"><i class="fas fa-share"></i> 3 shares</span>
            </div>
            <div class="post-actions-bar">
                <div class="post-action-btn">
                    <i class="far fa-thumbs-up"></i> Like
                </div>
                <div class="post-action-btn">
                    <i class="far fa-comment"></i> Comment
                </div>
                <div class="post-action-btn">
                    <i class="far fa-share-square"></i> Share
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Right Sidebar -->
<div class="sidebar right">
    <div class="sidebar-card">
        <h6 class="mb-3">Sponsored</h6>
        <div class="sponsored-item mb-3">
            <img src="https://via.placeholder.com/300x200" alt="Sponsored" class="img-fluid rounded mb-2">
            <h6 class="small">Sponsored Content</h6>
            <small class="text-muted">sponsored.com</small>
        </div>
        <div class="sponsored-item">
            <img src="https://via.placeholder.com/300x200" alt="Sponsored" class="img-fluid rounded mb-2">
            <h6 class="small">Another Sponsored Content</h6>
            <small class="text-muted">sponsored.com</small>
        </div>
    </div>
</div>


@endsection