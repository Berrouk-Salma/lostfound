
@extends('layouts.app')

@section('content')
<style>
    /* Custom CSS Styling */
    .form-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .form-card {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    
    .form-header {
        background: linear-gradient(to right, #3a86ed, #4e46e5);
        padding: 25px 30px;
        color: white;
    }
    
    .form-title {
        font-size: 28px;
        font-weight: bold;
        margin: 0;
        margin-bottom: 8px;
    }
    
    .form-subtitle {
        color: rgba(255, 255, 255, 0.9);
        margin: 0;
        font-size: 16px;
    }
    
    .form-content {
        padding: 30px;
    }
    
    .form-group {
        margin-bottom: 25px;
        position: relative;
    }
    
    .form-label {
        display: block;
        font-size: 14px;
        color: #555;
        margin-bottom: 8px;
        font-weight: 500;
    }
    
    .form-input {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e2e8f0;
        border-radius: 6px;
        font-size: 15px;
        transition: all 0.3s;
        background-color: white;
    }
    
    .form-input:focus {
        border-color: #3a86ed;
        outline: none;
        box-shadow: 0 0 0 3px rgba(58, 134, 237, 0.1);
    }
    
    .form-textarea {
        min-height: 100px;
        resize: vertical;
    }
    
    .form-row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -10px;
    }
    
    .form-col {
        flex: 1;
        padding: 0 10px;
        min-width: 200px;
    }
    
    .contact-section {
        background-color: #f0f7ff;
        border: 1px solid #e6f0fd;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 25px;
    }
    
    .section-title {
        margin-top: 0;
        margin-bottom: 15px;
        color: #2563eb;
        font-size: 18px;
        font-weight: 600;
    }
    
    .submit-button {
        width: 100%;
        background: linear-gradient(to right, #3a86ed, #4e46e5);
        color: white;
        border: none;
        padding: 14px 25px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 4px 6px rgba(58, 134, 237, 0.2);
    }
    
    .submit-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 10px rgba(58, 134, 237, 0.3);
    }
    
    .category-select-container {
        position: relative;
    }
    
    .category-select {
        padding-left: 15px;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%236b7280' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: calc(100% - 15px) center;
    }
    
    @media (max-width: 768px) {
        .form-row {
            flex-direction: column;
        }
        
        .form-col {
            width: 100%;
            margin-bottom: 20px;
        }
        
        .form-col:last-child {
            margin-bottom: 0;
        }
    }
</style>

<div class="form-container">
    <div class="form-card">
        <div class="form-header">
            <h1 class="form-title">Edit Lost or Found Item</h1>
            <p class="form-subtitle">Update the details to help reconnect people with their belongings</p>
        </div>
        
        <div class="form-content">
            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="title" class="form-label">What did you lose/find?</label>
                    <input type="text" id="title" name="title" value="{{ $post->title }}" class="form-input" required>
                </div>
                
                <div class="form-group">
                    <label for="description" class="form-label">Detailed description</label>
                    <textarea id="description" name="description" class="form-input form-textarea" required>{{ $post->description }}</textarea>
                </div>
                
                <div class="form-group">
                    <label for="photo" class="form-label">Photo (optional)</label>
                    <input type="file" id="photo" name="photo" class="form-input">
                </div>
                
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="date" class="form-label">When?</label>
                            <input type="date" id="date" name="date" value="{{ $post->date }}" class="form-input" required>
                        </div>
                    </div>
                    
                    <div class="form-col">
                        <div class="form-group">
                            <label for="location" class="form-label">Where?</label>
                            <input type="text" id="location" name="location" value="{{ $post->location }}" class="form-input" required>
                        </div>
                    </div>
                </div>
                
                <div class="contact-section">
                    <h3 class="section-title">Contact Information</h3>
                    
                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label for="contact_email" class="form-label">Email</label>
                                <input type="email" id="contact_email" name="contact_email" value="{{ $post->contact_email }}" class="form-input" required>
                            </div>
                        </div>
                        
                        <div class="form-col">
                            <div class="form-group">
                                <label for="contact_phone" class="form-label">Phone</label>
                                <input type="text" id="contact_phone" name="contact_phone" value="{{ $post->contact_phone }}" class="form-input" required>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="category" class="form-label">Category</label>
                    <div class="category-select-container">
                        <select id="category" name="category" class="form-input category-select" required>
                            <option value="electronics" {{ $post->category == 'electronics' ? 'selected' : '' }}>Electronics</option>
                            <option value="jewelry" {{ $post->category == 'jewelry' ? 'selected' : '' }}>Jewelry</option>
                            <option value="clothing" {{ $post->category == 'clothing' ? 'selected' : '' }}>Clothing</option>
                            <option value="documents" {{ $post->category == 'documents' ? 'selected' : '' }}>Documents</option>
                            <option value="pets" {{ $post->category == 'pets' ? 'selected' : '' }}>Pets</option>
                            <option value="other" {{ $post->category == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="submit-button">Update Post</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection