@extends('layouts.master')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">
    <h1 class="text-4xl font-bold text-gray-800 mb-6">All Blogs</h1>

    @forelse ($posts as $post)
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-2">{{ $post->title }}</h2>
            <p class="text-gray-600 mb-4">
                {{ Str::limit($post->content, 150) }}
            </p>
            <a href="{{ route('post.show', $post->id) }}"
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
               Read More
            </a>
        </div>
    @empty
        <p class="text-gray-600">No posts available.</p>
    @endforelse

    <div class="mt-6">
        {{ $posts->links() }}
    </div>
</div>
@endsection
