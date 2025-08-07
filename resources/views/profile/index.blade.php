@extends('layouts.master')

@section('title', 'My Profile')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <div class="py-8 relative w-full min-h-[300px] flex flex-col items-center justify-center text-center overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-[#2c9a7a] to-[#03503A]"></div>
        
        <div class="relative z-10 flex flex-col gap-4 items-center">
            <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center shadow-lg">
                <span class="text-3xl font-bold text-[#03503A]">{{ substr(Auth::user()->name, 0, 1) }}</span>
            </div>
            <h1 class="text-4xl md:text-5xl text-white font-extrabold">{{ Auth::user()->name }}</h1>
            <p class="text-lg text-white opacity-75">{{ Auth::user()->email }}</p>
            
            <!-- User Stats -->
            <div class="flex gap-8 mt-4">
                <div class="text-center">
                    <div class="text-2xl font-bold text-white">{{ $userPosts->count() }}</div>
                    <div class="text-sm text-white opacity-75">Posts</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-white">{{ $userPosts->sum('views_count') }}</div>
                    <div class="text-sm text-white opacity-75">Total Views</div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <!-- Action Buttons -->
        <div class="flex flex-col md:flex-row gap-4 mb-8">
            <button onclick="showCreateForm()" 
                    class="px-6 py-3 bg-[#2C9A7A] text-white rounded-md hover:bg-[#03503A] transition-all font-semibold">
                + Create New Post
            </button>
            <div class="flex gap-2">
                <button onclick="filterPosts('all')" 
                        class="filter-btn active px-4 py-2 bg-white border-2 border-[#2C9A7A] text-[#03503A] rounded-md hover:bg-[#2C9A7A] hover:text-white transition-all">
                    All Posts
                </button>
                <button onclick="filterPosts('P')" 
                        class="filter-btn px-4 py-2 bg-white border-2 border-[#2C9A7A] text-[#03503A] rounded-md hover:bg-[#2C9A7A] hover:text-white transition-all">
                    Published
                </button>
                <button onclick="filterPosts('D')" 
                        class="filter-btn px-4 py-2 bg-white border-2 border-[#2C9A7A] text-[#03503A] rounded-md hover:bg-[#2C9A7A] hover:text-white transition-all">
                    Drafts
                </button>
            </div>
        </div>

        <!-- Create Post Form (Hidden by default) -->
        <div id="create-form" class="hidden bg-white rounded-lg shadow-lg p-6 mb-8">
            <h3 class="text-2xl font-bold text-[#03503A] mb-6">Create New Post</h3>
            
            <form action="{{ route('post.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label class="block text-sm font-medium text-[#03503A] mb-2">Title *</label>
                    <input type="text" name="title" required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#2C9A7A] focus:border-[#2C9A7A]"
                           placeholder="Enter post title">
                </div>

                <div>
                    <label class="block text-sm font-medium text-[#03503A] mb-2">Content *</label>
                    <textarea name="content" rows="10" required
                              class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#2C9A7A] focus:border-[#2C9A7A]"
                              placeholder="Write your post content here..."></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-[#03503A] mb-2">Featured Image URL</label>
                    <input type="url" name="featured_image_url" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#2C9A7A] focus:border-[#2C9A7A]"
                           placeholder="https://example.com/image.jpg">
                </div>

                <div>
                    <label class="block text-sm font-medium text-[#03503A] mb-2">Status *</label>
                    <select name="status" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#2C9A7A] focus:border-[#2C9A7A]">
                        <option value="D">Draft</option>
                        <option value="P">Published</option>
                        <option value="I">Inactive</option>
                    </select>
                </div>

                @if($categories->count() > 0)
                <div>
                    <label class="block text-sm font-medium text-[#03503A] mb-2">Categories</label>
                    <div class="flex flex-wrap gap-2">
                        @foreach($categories as $category)
                        <label class="flex items-center">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="mr-2">
                            <span class="text-sm">{{ $category->category_name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($tags->count() > 0)
                <div>
                    <label class="block text-sm font-medium text-[#03503A] mb-2">Tags</label>
                    <div class="flex flex-wrap gap-2">
                        @foreach($tags as $tag)
                        <label class="flex items-center">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="mr-2">
                            <span class="text-sm">{{ $tag->tag_name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="flex gap-4">
                    <button type="submit" 
                            class="px-6 py-3 bg-[#2C9A7A] text-white rounded-md hover:bg-[#03503A] transition-all font-semibold">
                        Create Post
                    </button>
                    <button type="button" onclick="hideCreateForm()" 
                            class="px-6 py-3 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-all">
                        Cancel
                    </button>
                </div>
            </form>
        </div>

        <!-- Posts Grid -->
        <div class="grid gap-6">
            @forelse($userPosts as $post)
            <div class="post-item bg-white rounded-lg shadow-lg overflow-hidden" data-status="{{ $post->status }}">
                <div class="md:flex">
                    <!-- Image -->
                    <div class="md:flex-shrink-0">
                        @if($post->featured_image_url)
                        <img class="h-48 w-full object-cover md:w-64" src="{{ $post->featured_image_url }}" alt="{{ $post->title }}">
                        @else
                        <div class="h-48 w-full md:w-64 bg-gradient-to-br from-[#2C9A7A] to-[#03503A] flex items-center justify-center">
                            <span class="text-white text-6xl font-bold">{{ substr($post->title, 0, 1) }}</span>
                        </div>
                        @endif
                    </div>
                    
                    <!-- Content -->
                    <div class="p-6 flex-1">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-[#03503A] mb-2">{{ $post->title }}</h3>
                                <p class="text-gray-600 text-sm mb-2">{{ Str::limit($post->content, 150) }}</p>
                            </div>
                            
                            <!-- Status Badge -->
                            <span class="px-3 py-1 rounded-full text-xs font-medium
                                @if($post->status === 'P') bg-green-100 text-green-800
                                @elseif($post->status === 'D') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800 @endif">
                                @if($post->status === 'P') Published
                                @elseif($post->status === 'D') Draft
                                @else Inactive @endif
                            </span>
                        </div>
                        
                        <!-- Meta Info -->
                        <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
                            @if($post->publication_date)
                            <span>Published: {{ \Carbon\Carbon::parse($post->publication_date)->format('M d, Y') }}</span>
                            @endif
                            <span>{{ number_format($post->views_count) }} views</span>
                        </div>
                        
                        <!-- Actions -->
                        <div class="flex gap-2">
                            <a href="{{ route('post.show', $post->id) }}" 
                               class="px-4 py-2 bg-[#2C9A7A] text-white rounded-md hover:bg-[#03503A] transition-all text-sm">
                                View
                            </a>
                            <a href="{{ route('post.edit', $post->id) }}" 
                               class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-all text-sm">
                                Edit
                            </a>
                            <form action="{{ route('post.destroy', $post->id) }}" method="POST" class="inline" 
                                  onsubmit="return confirm('Are you sure you want to delete this post?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-all text-sm">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-12">
                <div class="text-6xl mb-4">📝</div>
                <h3 class="text-2xl font-bold text-[#03503A] mb-2">No posts yet</h3>
                <p class="text-gray-600 mb-6">Start sharing your thoughts with the world!</p>
                <button onclick="showCreateForm()" 
                        class="px-6 py-3 bg-[#2C9A7A] text-white rounded-md hover:bg-[#03503A] transition-all font-semibold">
                    Create Your First Post
                </button>
            </div>
            @endforelse
        </div>
    </div>
</div>

<script>
function showCreateForm() {
    document.getElementById('create-form').classList.remove('hidden');
    document.getElementById('create-form').scrollIntoView({ behavior: 'smooth' });
}

function hideCreateForm() {
    document.getElementById('create-form').classList.add('hidden');
}

function filterPosts(status) {
    const posts = document.querySelectorAll('.post-item');
    const buttons = document.querySelectorAll('.filter-btn');
    
    // Update button styles
    buttons.forEach(btn => {
        btn.classList.remove('active', 'bg-[#2C9A7A]', 'text-white');
        btn.classList.add('bg-white', 'text-[#03503A]');
    });
    
    event.target.classList.add('active', 'bg-[#2C9A7A]', 'text-white');
    event.target.classList.remove('bg-white', 'text-[#03503A]');
    
    // Filter posts
    posts.forEach(post => {
        if (status === 'all' || post.dataset.status === status) {
            post.style.display = 'block';
        } else {
            post.style.display = 'none';
        }
    });
}

// Success message auto-hide
@if(session('success'))
setTimeout(() => {
    const alert = document.querySelector('.alert');
    if (alert) alert.remove();
}, 5000);
@endif
</script>

@if(session('success'))
<div class="alert fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
    {{ session('success') }}
</div>
@endif
@endsection