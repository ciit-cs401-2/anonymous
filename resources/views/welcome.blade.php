@extends('layouts.master')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<div
  class="relative w-full min-h-[500px] md:min-h-[600px] flex flex-col gap-12 items-center justify-center text-center overflow-hidden"
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
    <h1 class="text-4xl md:text-5xl text-white font-extrabold">
      Budget Smarter. Study Harder.
    </h1>
    <h2 class="text-md md:text-lg text-white opacity-75 font-regular">
      Learn to Stretch Your Allowance and Build Real-World Money Skills.
    </h2>
    <button
      class="px-10 py-3 rounded-md text-md bg-white text-[#03503A] cursor-pointer hover:bg-neutral-100 transition-all"
    >
      Start Reading
    </button>
  </div>
</div>

<div class="container mx-auto px-4 py-8 md:py-16">
    <!-- Featured Post -->
    <h3 class="text-3xl font-extrabold text-[#03503A] mb-8">Featured Post</h3>
    @include('components.featured-post', ['featuredPosts' => $featuredPosts])

    <!-- Recent Posts -->
    <div class="mt-16">
      <div class="flex justify-between items-center mb-8">
        <h3 class="text-3xl font-bold text-[#03503A]">Recent Posts</h3>
        <button class="px-6 py-2 rounded-sm text-sm text-white bg-[#2C9A7A] hover:bg-[#03503A] cursor-pointer transition-all">View More</h3>
      </div>
      @include('components.recent-posts', ['recentPosts' => $recentPosts])
    </div>

    <!-- Most Popular -->
    <div class="mt-16">
      <div class="flex justify-between items-center mb-8">
        <h3 class="text-3xl font-bold text-[#03503A]">Most Popular</h3>
        <button class="px-6 py-2 rounded-sm text-sm text-white bg-[#2C9A7A] hover:bg-[#03503A] cursor-pointer transition-all">View More</h3>
      </div>
      @include('components.most-popular', ['mostPopular' => $mostPopular])
    </div>
</div>

<!-- Mailing List -->
<div
  class="relative w-full min-h-[400px] flex flex-col gap-12 items-center justify-center text-center overflow-hidden"
>
  <!-- Background Image -->
  <div
    class="absolute inset-0 bg-cover bg-center bg-no-repeat"
    style="background-image: url('{{ asset('mailing.png') }}');"
  ></div>

  <!-- Gradient Overlay -->
  <div class="absolute inset-0 bg-gradient-to-b from-[#2c9a7a]/60 to-[#1e6f5a]/80"></div>

  <!-- Content -->
  <div class="relative z-10 flex flex-col gap-4 items-center w-full px-4">
    <h1 class="text-3xl md:text-5xl text-white font-extrabold text-center">
      Get our stories delivered from us to your inbox weekly.
    </h1>

    <h2 class="text-sm md:text-lg text-white opacity-75 font-regular text-center">
      Enter your email to subscribe to our mailing list!
    </h2>

    <!-- Input and Button -->
    <form class="px-12 md:px-0 w-full md:max-w-md flex flex-col md:flex-row items-center gap-2">
      <input
        type="email"
        placeholder="Enter your email"
        class="w-full px-4 py-3 text-white placeholder-white bg-[#03503A] border border-white rounded-md focus:outline-none focus:ring-2 focus:ring-white focus:border-white"
        required
      />
      <button
        type="submit"
        class="bg-white w-full text-[#03503A] font-semibold px-6 py-3 rounded-md hover:bg-neutral-100 transition"
      >
        Subscribe
      </button>
    </form>
  </div>
</div>
@endsection