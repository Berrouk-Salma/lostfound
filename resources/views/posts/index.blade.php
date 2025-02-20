@extends('layouts.part')

@section('content')
<style>
    /* Custom CSS Styling */
    .posts-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 20px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }
    
    .page-title {
        font-size: 32px;
        color: #2d3748;
        margin: 0;
        font-weight: 700;
    }
    
    .create-button {
        background: linear-gradient(to right, #3a86ed, #4e46e5);
        color: white;
        text-decoration: none;
        padding: 12px 20px;
        border-radius: 8px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s;
        box-shadow: 0 4px 6px rgba(58, 134, 237, 0.2);
    }
    
    .create-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 10px rgba(58, 134, 237, 0.3);
    }
    
    .create-button svg {
        margin-right: 8px;
    }
    
    .posts-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .post-item {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        margin-bottom: 16px;
        transition: transform 0.2s, box-shadow 0.2s;
        overflow: hidden;
    }
    
    .post-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.12);
    }
    
    .post-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 25px;
    }
    
    .post-title {
        font-size: 18px;
        color: #4a5568;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s;
        flex-grow: 1;
    }
    
    .post-title:hover {
        color: #3a86ed;
    }
    
    .post-actions {
        display: flex;
        align-items: center;
    }
    
    .edit-button {
        background-color: #ebf5ff;
        color: #3a86ed;
        border: none;
        border-radius: 6px;
        padding: 8px 12px;
        margin-right: 10px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 500;
        transition: background-color 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }
    
    .edit-button:hover {
        background-color: #dbeafe;
    }
    
    .edit-button svg {
        margin-right: 5px;
    }
    
    .delete-button {
        background-color: #fee2e2;
        color: #ef4444;
        border: none;
        border-radius: 6px;
        padding: 8px 12px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 500;
        transition: background-color 0.2s;
        display: inline-flex;
        align-items: center;
    }
    
    .delete-button:hover {
        background-color: #fecaca;
    }
    
    .delete-button svg {
        margin-right: 5px;
    }
    
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #6b7280;
        background-color: #f9fafb;
        border-radius: 10px;
        border: 2px dashed #e2e8f0;
    }
    
    .empty-icon {
        font-size: 48px;
        margin-bottom: 10px;
        color: #d1d5db;
    }
    
    .empty-message {
        font-size: 18px;
        margin-bottom: 20px;
    }
</style>

<div class="posts-container">
    <div class="page-header">
        <h1 class="page-title">Lost & Found Items</h1>
        <a href="{{ route('posts.create') }}" class="create-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg>
            Add New Item
        </a>
    </div>
    
    @if(count($posts) > 0)
        <ul class="posts-list">
            @foreach ($posts as $post)
                <li class="post-item">
                    <div class="post-content">
                        <a href="{{ route('posts.show', $post->id) }}" class="post-title">
                            {{ $post->title }}
                        </a>
                        <div class="post-actions">
                            <a href="{{ route('posts.edit', $post->id) }}" class="edit-button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                </svg>
                                Edit
                            </a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="margin: 0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-button" onclick="return confirm('Are you sure you want to delete this item?')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <div class="empty-state">
            <div class="empty-icon">📦</div>
            <p class="empty-message">No lost & found items yet</p>
            <a href="{{ route('posts.create') }}" class="create-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
                Add Your First Item
            </a>
        </div>
    @endif
</div>
@endsection