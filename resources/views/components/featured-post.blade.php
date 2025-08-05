<div class="flex flex-col w-full rounded-lg">
    <!-- Featured Image -->
    <div class="h-120">
        <img
            class="h-full w-full object-cover rounded-lg"
            src="{{ $featuredPosts->featured_image_url }}"
            alt="Featured Post Image"
        >
    </div>

    <!-- Content Box -->
    <div class="bg-white p-8 flex flex-col justify-center rounded-lg w-[70%] -mt-50 self-center shadow-md">
        <!-- Title -->
        <h2 class="text-4xl font-bold mb-2 leading-tight text-black">
            {{ $featuredPosts->title }}.
        </h2>

        <!-- Date & Views -->
        <div class="text-sm text-neutral-500 mb-6 flex items-center gap-4">
            <span class="uppercase font-bold">{{ $featuredPosts->categories()->first()->category_name }}</span> • 
            <span>{{ \Carbon\Carbon::parse($featuredPosts->publication_date)->format('F j, Y') }}</span>
            <span class="flex items-center gap-1">
                <svg class="w-4 h-4 text-neutral-400" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2C5 2 1.73 7.11 1 10c.73 2.89 4 8 9 8s8.27-5.11 9-8c-.73-2.89-4-8-9-8zm0 14c-3.31 0-6.31-3.07-7.41-6C3.69 7.07 6.69 4 10 4s6.31 3.07 7.41 6c-1.1 2.93-4.1 6-7.41 6zm0-10a4 4 0 100 8 4 4 0 000-8z"/></svg>
                {{ number_format($featuredPosts->views_count) }} views
            </span>
        </div>

        <!-- Content -->
        <p class="text-neutral-700 text-lg mb-6">
            {{ $featuredPosts->content }}
        </p>

        <!-- Button -->
        <button class="bg-[#2C9A7A] hover:bg-[#03503A] text-white font-bold py-2 px-6 rounded-lg self-start">
            Read More
        </button>
    </div>
</div>
