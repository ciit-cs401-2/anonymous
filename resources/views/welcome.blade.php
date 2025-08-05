@extends('layouts.master')

@section('title', 'Home')

@section('content')
<div
  class="relative w-full min-h-[400px] flex flex-col gap-12 items-center justify-center text-center overflow-hidden"
>
  <!-- Background Image -->
  <div
    class="absolute inset-0 bg-cover bg-center bg-no-repeat"
    style="background-image: url('{{ asset('duotone-hero.png') }}');"
  ></div>

  <!-- Gradient Overlay -->
  <div class="absolute inset-0 bg-gradient-to-b from-[#2c9a7a]/60 to-[#1e6f5a]/80"></div>

  <!-- Content -->
  <div class="relative z-10 flex flex-col gap-4 items-center">
    <h1 class="text-5xl text-white font-extrabold">
      Budget Smarter. Study Harder.
    </h1>
    <h2 class="text-lg text-white opacity-75 font-regular">
      Learn to Stretch Your Allowance and Build Real-World Money Skills.
    </h2>
    <button
      class="mt-6 px-10 py-3 rounded-md text-md bg-white text-[#03503A] cursor-pointer hover:bg-neutral-100 transition-all"
    >
      Start Reading
    </button>
  </div>
</div>



<div class="container mx-auto px-4 py-16">

    <!-- Featured Post -->
    <h1 class="text-xl sm:text-3xl md:text-4xl font-extrabold text-[#03503A] mb-8">Featured Post</h1>
    @include('components.featured-post', ['featuredPosts' => $featuredPosts])

    <!-- Recent Posts -->
    <div class="mt-16">
      <div class="flex justify-between items-center">
        <h3 class="text-3xl font-bold mb-6 text-[#03503A]">Recent Posts</h3>
        <button class="px-6 py-2 rounded-sm text-sm text-white bg-[#2C9A7A] hover:bg-[#03503A] cursor-pointer transition-all">View More</h3>
      </div>
      @include('components.recent-posts', ['recentPosts' => $recentPosts])
    </div>

    <!-- Most Popular -->
    <div class="flex flex-col gap-8 mt-8">
        <div>
            @include('components.most-popular', ['mostPopular' => $mostPopular])
            @include('components.categories', ['categories' => $categories])
        </div>
    </div>
</div>
@endsection