<div class="flex gap-4 w-full">
    @foreach ($recentPosts->take(3) as $post)
    <div class="flex-1 flex flex-col gap-8 py-6"> {{-- Adjust background color --}}
        <div class="w-full">
            <img class="w-full aspect-square object-cover rounded-lg" src="{{$post->featured_image_url}}" alt="Recent Post Image">
        </div>
        <div>
            <p class="text-[#2C9A7A] text-sm mb-1 space-x-2">
                <span class="font-bold uppercase">{{ $post->categories()->first()->category_name }}</span>
                <span>{{ \Carbon\Carbon::parse($featuredPosts->publication_date)->format('F j, Y') }}</span>
            </p>
            <h4 class="text-xl font-bold mb-2 text-black">{{$post->title}}</h4>
            <p class="text-neutral-500 text-sm mb-3">{{Str::limit($post->content, 150)}}</p>
            <a href="#" class="text-[#2C9A7A] hover:underline text-sm">Read More</a>
        </div>
        {{-- You can repeat the above structure for more recent posts --}}
    </div>
    @endforeach
</div>