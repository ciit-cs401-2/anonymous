@extends('layouts.master')

@section('title', $post->title)

@section('content')
<div class="min-h-screen bg-[#0f0f23] text-white">
    <!-- Hero Section with Featured Image -->
    <div class="relative h-96 md:h-[500px] bg-gradient-to-b from-transparent to-[#0f0f23]">
        @if($post->featured_image_url)
            <img src="{{ $post->featured_image_url }}" 
                 alt="{{ $post->title }}" 
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        @else
            <div class="w-full h-full bg-gradient-to-br from-[#24263b] to-[#0f0f23]"></div>
        @endif
        
        <!-- Title Overlay -->
        <div class="absolute bottom-0 left-0 right-0 p-8 md:p-16">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-4xl md:text-6xl font-bold mb-4 leading-tight">
                    {{ $post->title }}
                </h1>
                
                <!-- Post Meta -->
                <div class="flex flex-wrap items-center gap-6 text-gray-300">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                        <span>{{ $post->user->name }}</span>
                    </div>
                    
                    @if($post->publication_date)
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                        </svg>
                        <span>{{ \Carbon\Carbon::parse($post->publication_date)->format('M d, Y') }}</span>
                    </div>
                    @endif
                    
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>{{ number_format($post->views_count) }} views</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-8 py-16">
        <!-- Categories and Tags -->
        @if($post->categories->count() > 0 || $post->tags->count() > 0)
        <div class="mb-8 flex flex-wrap gap-4">
            @foreach($post->categories as $category)
            <span class="bg-[#e94560] text-white px-3 py-1 rounded-full text-sm font-medium">
                {{ $category->name }}
            </span>
            @endforeach
            
            @foreach($post->tags as $tag)
            <span class="bg-[#24263b] text-gray-300 px-3 py-1 rounded-full text-sm border border-gray-600">
                #{{ $tag->name }}
            </span>
            @endforeach
        </div>
        @endif

        <!-- Post Content -->
        <div class="prose prose-lg prose-invert max-w-none">
            <div class="text-gray-300 leading-relaxed text-lg">
                {!! nl2br(e($post->content)) !!}
            </div>
        </div>

        <!-- Post Actions -->
        @auth
        @if($post->user_id === Auth::id() || Auth::user()->roles->pluck('role_name')->contains('A'))
        <div class="mt-12 pt-8 border-t border-gray-700">
            <div class="flex gap-4">
                <a href="{{ route('post.edit', $post->id) }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                    Edit Post
                </a>
                
                <form action="{{ route('post.destroy', $post->id) }}" method="POST" class="inline" 
                      onsubmit="return confirm('Are you sure you want to delete this post?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                        Delete Post
                    </button>
                </form>
            </div>
        </div>
        @endif
        @endauth

        <!-- Navigation -->
        <div class="mt-16 pt-8 border-t border-gray-700">
            <div class="flex justify-between">
                <a href="{{ route('post.index') }}" 
                   class="flex items-center gap-2 text-[#e94560] hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    Back to Posts
                </a>
                
                <div class="flex gap-4">
                    <button onclick="sharePost()" 
                            class="flex items-center gap-2 text-gray-400 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z"></path>
                        </svg>
                        Share
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Comments Section (if you have comments) -->
    @if($post->comments->count() > 0)
    <div class="max-w-4xl mx-auto px-8 pb-16">
        <div class="border-t border-gray-700 pt-12">
            <h3 class="text-2xl font-bold mb-8">Comments ({{ $post->comments->count() }})</h3>
            
            @foreach($post->comments as $comment)
            <div class="bg-[#24263b] rounded-lg p-6 mb-6">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 bg-[#e94560] rounded-full flex items-center justify-center">
                        <span class="text-white font-bold">{{ substr($comment->user->name, 0, 1) }}</span>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="font-medium text-white">{{ $comment->user->name }}</span>
                            <span class="text-gray-400 text-sm">{{ $comment->created_at->format('M d, Y') }}</span>
                        </div>
                        <p class="text-gray-300">{{ $comment->content }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

<script>
function sharePost() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $post->title }}',
            text: 'Check out this blog post!',
            url: window.location.href
        });
    } else {
        // Fallback - copy to clipboard
        navigator.clipboard.writeText(window.location.href).then(function() {
            alert('Link copied to clipboard!');
        });
    }
}
</script>
@endsection