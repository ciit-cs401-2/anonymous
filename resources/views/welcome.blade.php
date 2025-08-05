@extends('layouts.master')

@section('title', 'Home')

@section('content')
<div class="bg-white rounded-lg p-8 shadow-lg">
    <h1 class="text-3xl sm:text-5xl md:text-6xl font-extrabold text-black mb-6">
        Welcome to ThriftEd!
    </h1>
    <h2 class="text-xl md:text-2xl text-black mb-4">
        Manage your finances securely!
    </h2>
    <p class="text-gray-700 text-md mb-10">
        Discover expert tips, tools, and stories to help you save smarter, invest wisely, and take control of your financial future.
    </p>

    {{-- Featured Financial Insights --}}
    <h2 class="text-2xl font-bold text-black mb-4">Featured Financial Insight</h2>
    @include('components.featured-post', ['featuredPosts' => $featuredPosts])

    {{-- Grid Section --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
        {{-- Recent Posts --}}
        <div class="md:col-span-2">
            <h2 class="text-2xl font-bold text-black mb-4">Latest Financial Articles</h2>
            @include('components.recent-posts', ['recentPosts' => $recentPosts])
        </div>

        {{-- Sidebar --}}
        <div>
            <h2 class="text-2xl font-bold text-black mb-4">Popular Topics</h2>
            @include('components.most-popular', ['mostPopular' => $mostPopular])
            
            <h2 class="text-2xl font-bold text-black mt-8 mb-4">Browse by Category</h2>
            @include('components.categories', ['categories' => $categories])
        </div>
    </div>
</div>
@endsection
