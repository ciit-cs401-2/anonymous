@if ($featuredPosts)
<div class="bg-[#24263b] rounded-lg shadow-lg overflow-hidden md:flex"> {{-- Adjust background color --}}
    <div class="md:flex-shrink-0">
        <img class="h-full w-full object-cover md:w-96" src="{{$featuredPosts->featured_image_url}}"
            alt="Featured Post Image">
    </div>
    <div class="p-8 flex flex-col justify-center">
        <h2 class="text-4xl font-bold mb-4 leading-tight text-white">{{$featuredPosts->title}}.</h2>
        <p class="text-gray-300 text-lg mb-6">{{$featuredPosts->content}}</p>
        <button class="bg-[#e94560] hover:bg-[#c2364e] text-white font-bold py-2 px-4 rounded self-start">Read
            More</button>
    </div>
</div>
@endif

{{-- Featured Post Component --}}