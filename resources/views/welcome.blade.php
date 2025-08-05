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
      Read More
    </button>
  </div>
</div>



<div class="container mx-auto px-4 py-16">
    <h1 class="text-xs sm:text-5xl md:text-6xl font-extrabold text-[#03503A] mb-12">Featured Post</h1>
    @include('components.featured-post', ['featuredPosts' => $featuredPosts])

    <h2 class="text-3xl font-bold mb-6 text-[#03503A]">Discover Game Ako featured stories</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
        <div class="md:col-span-2">
            @include('components.recent-posts', ['recentPosts' => $recentPosts])
        </div>
        <div>
            @include('components.most-popular', ['mostPopular' => $mostPopular])
            @include('components.categories', ['categories' => $categories])
        </div>
    </div>
</div>
@endsection