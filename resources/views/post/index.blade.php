@extends('layouts.master')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">
    <h1 class="text-4xl font-bold text-[#03503A] mb-6">All Blogs</h1>

    @forelse ($posts as $post)
        <div class="bg-white rounded-lg mb-6 flex flex-col md:flex-row gap-4 overflow-hidden">
            <div class="w-full h-60 md:h-auto md:min-w-60 md:max-w-60">
                <img class="w-full h-full rounded-lg aspect-square object-cover" src="{{$post->featured_image_url}}" alt="Post Image">
            </div>
            <div class="flex flex-col h-full p-6 justify-start items-start md:items-start md:justify-center my-auto">
                <h2 class="text-2xl font-semibold text-black mb-2">{{ $post->title }}</h2>
                <p class="text-neutral-600 mb-4">
                    {{ Str::limit($post->content, 150) }}
                </p>
                <a href="{{ route('post.show', $post->id) }}"
                class="inline-block bg-[#2C9A7A] hover:bg-[#03503A] text-white font-bold py-2 px-4 rounded transition-all">
                Read More
                </a>
            </div>
        </div>
    @empty
        <p class="text-gray-600">No posts available.</p>
    @endforelse

    <div class="mt-6">
        {{ $posts->links() }}
    </div>
</div>
@endsection
