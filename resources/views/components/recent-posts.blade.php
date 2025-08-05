@foreach ($recentPosts->take(3) as $post)
<div class="bg-[#24263b] flex-1 flex flex-col gap-4 rounded-lg shadow-lg p-6"> {{-- Adjust background color --}}
    <div class="flex-shrink-0">
        <img class="w-32 h-32 object-cover rounded-lg" src="{{$post->featured_image_url}}" alt="Recent Post Image">
    </div>
    <div>
        <p class="text-[#e94560] text-sm mb-1">{{date('Y-m-d', strtotime($post->publication_date)) }} -
            {{$post->categories()->first()->category_name}}</p>
        <h4 class="text-xl font-bold mb-2 text-white">{{$post->title}}</h4>
        <p class="text-gray-300 text-sm mb-3">{{Str::limit($post->content, 300)}}</p>
        <a href="#" class="text-[#e94560] hover:underline text-sm">Read More</a>
    </div>
    {{-- You can repeat the above structure for more recent posts --}}
</div>
@endforeach