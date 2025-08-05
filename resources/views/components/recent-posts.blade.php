<div class="flex flex-col md:flex-row gap-12 w-full">
    @foreach ($recentPosts->take(3) as $post)
    <div class="flex-1 flex flex-col gap-8 hover:scale-105 transition-all"> {{-- Adjust background color --}}
        <div class="w-full">
            <img class="w-full aspect-square object-cover rounded-lg" src="{{$post->featured_image_url}}" alt="Recent Post Image">
        </div>
        <div>
            <!-- Title -->
            <h4 class="text-xl font-bold mb-2 text-black">{{$post->title}}</h4>

            <!-- Date & Views -->
            <div class="text-sm text-[#2C9A7A] mb-2 flex items-center gap-4">
                <span class="uppercase font-bold">{{ $post->categories()->first()->category_name }}</span> • 
                <span>{{ \Carbon\Carbon::parse($post->publication_date)->format('F j, Y') }}</span>
                <span class="flex items-center gap-1">
                    <svg class="w-4 h-4 text-[#2C9A7A]" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2C5 2 1.73 7.11 1 10c.73 2.89 4 8 9 8s8.27-5.11 9-8c-.73-2.89-4-8-9-8zm0 14c-3.31 0-6.31-3.07-7.41-6C3.69 7.07 6.69 4 10 4s6.31 3.07 7.41 6c-1.1 2.93-4.1 6-7.41 6zm0-10a4 4 0 100 8 4 4 0 000-8z"/></svg>
                    {{ number_format($post->views_count) }} views
                </span>
            </div>

            <!-- Author -->
            <p class="text-[#2C9A7A] mb-6">By {{ $post->user->name }}</p>

            <!-- Content -->
            <p class="text-neutral-500 text-sm mb-3">{{Str::limit($post->content, 150)}}</p>

            <!-- Read More -->
            <a href="{{ route('post.show', $post->id) }}" class="text-[#2C9A7A] hover:underline text-sm">Read More</a>
        </div>
    </div>
    @endforeach
</div>
