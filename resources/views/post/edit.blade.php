@extends('layouts.master')

@section('title', 'Edit Post')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-gradient-to-r from-[#2c9a7a] to-[#03503A] py-16">
        <div class="max-w-4xl mx-auto px-8">
            <h1 class="text-4xl font-bold text-white mb-4">Edit Post</h1>
            <p class="text-white opacity-75">Make changes to your post</p>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-8 py-16">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <form action="{{ route('post.update', $post->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <!-- Title -->
                <div>
                    <label class="block text-sm font-medium text-[#03503A] mb-2">Title *</label>
                    <input type="text" name="title" value="{{ old('title', $post->title) }}" required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#2C9A7A] focus:border-[#2C9A7A] @error('title') border-red-500 @enderror">
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Content -->
                <div>
                    <label class="block text-sm font-medium text-[#03503A] mb-2">Content *</label>
                    <textarea name="content" rows="15" required
                              class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#2C9A7A] focus:border-[#2C9A7A] @error('content') border-red-500 @enderror">{{ old('content', $post->content) }}</textarea>
                    @error('content')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Featured Image URL -->
                <div>
                    <label class="block text-sm font-medium text-[#03503A] mb-2">Featured Image URL</label>
                    <input type="url" name="featured_image_url" value="{{ old('featured_image_url', $post->featured_image_url) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#2C9A7A] focus:border-[#2C9A7A] @error('featured_image_url') border-red-500 @enderror"
                           placeholder="https://example.com/image.jpg">
                    @error('featured_image_url')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    
                    <!-- Image Preview -->
                    @if($post->featured_image_url)
                    <div class="mt-4">
                        <p class="text-sm text-gray-600 mb-2">Current image:</p>
                        <img src="{{ $post->featured_image_url }}" alt="Current featured image" 
                             class="w-full max-w-md h-48 object-cover rounded-lg">
                    </div>
                    @endif
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-[#03503A] mb-2">Status *</label>
                    <select name="status" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#2C9A7A] focus:border-[#2C9A7A] @error('status') border-red-500 @enderror">
                        <option value="D" {{ old('status', $post->status) === 'D' ? 'selected' : '' }}>Draft</option>
                        <option value="P" {{ old('status', $post->status) === 'P' ? 'selected' : '' }}>Published</option>
                        <option value="I" {{ old('status', $post->status) === 'I' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Categories -->
                @if($categories->count() > 0)
                <div>
                    <label class="block text-sm font-medium text-[#03503A] mb-3">Categories</label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach($categories as $category)
                        <label class="flex items-center p-3 border border-gray-300 rounded-md hover:bg-gray-50 cursor-pointer">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}" 
                                   {{ $post->categories->contains('id', $category->id) ? 'checked' : '' }}
                                   class="mr-3 text-[#2C9A7A] focus:ring-[#2C9A7A] focus:ring-2">
                            <span class="text-sm font-medium">{{ $category->category_name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Tags -->
                @if($tags->count() > 0)
                <div>
                    <label class="block text-sm font-medium text-[#03503A] mb-3">Tags</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        @foreach($tags as $tag)
                        <label class="flex items-center p-3 border border-gray-300 rounded-md hover:bg-gray-50 cursor-pointer">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" 
                                   {{ $post->tags->contains('id', $tag->id) ? 'checked' : '' }}
                                   class="mr-3 text-[#2C9A7A] focus:ring-[#2C9A7A] focus:ring-2">
                            <span class="text-sm">{{ $tag->tag_name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Current Post Info -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="font-medium text-[#03503A] mb-2">Post Information</h4>
                    <div class="text-sm text-gray-600 space-y-1">
                        @if($post->publication_date)
                        <p><span class="font-medium">Published:</span> {{ \Carbon\Carbon::parse($post->publication_date)->format('M d, Y \a\t g:i A') }}</p>
                        @endif
                        @if($post->last_modified_date)
                        <p><span class="font-medium">Last Modified:</span> {{ \Carbon\Carbon::parse($post->last_modified_date)->format('M d, Y \a\t g:i A') }}</p>
                        @endif
                        <p><span class="font-medium">Views:</span> {{ number_format($post->views_count) }}</p>
                        <p><span class="font-medium">Slug:</span> {{ $post->slug }}</p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col md:flex-row gap-4 pt-6 border-t border-gray-200">
                    <button type="submit" 
                            class="px-8 py-3 bg-[#2C9A7A] text-white rounded-md hover:bg-[#03503A] transition-all font-semibold">
                        Update Post
                    </button>
                    
                    <a href="{{ route('post.show', $post->id) }}" 
                       class="px-8 py-3 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-all text-center">
                        Cancel
                    </a>
                    
                    <div class="md:ml-auto flex gap-2">
                        <a href="{{ route('profile.index') }}" 
                           class="px-6 py-3 border border-[#2C9A7A] text-[#2C9A7A] rounded-md hover:bg-[#2C9A7A] hover:text-white transition-all">
                            My Posts
                        </a>
                        
                        <form action="{{ route('post.destroy', $post->id) }}" method="POST" class="inline" 
                              onsubmit="return confirm('Are you sure you want to delete this post? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="px-6 py-3 bg-red-600 text-white rounded-md hover:bg-red-700 transition-all">
                                Delete Post
                            </button>
                        </form>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@if(session('success'))
<div class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
    {{ session('success') }}
</div>
<script>
setTimeout(() => {
    const alert = document.querySelector('.fixed.top-4');
    if (alert) alert.remove();
}, 5000);
</script>
@endif
@endsection