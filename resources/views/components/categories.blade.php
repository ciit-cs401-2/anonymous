<div class="mt-8">
    <p class="text-gray-400 text-lg mb-2">Discover by topic</p>
    <h3 class="text-4xl font-bold mb-6 text-white">Categories</h3>

    <div class="grid grid-cols-2 gap-4">
        @foreach ($categories as $category)
            @php
                $categoryColor = '';
                $categoryHoverColor = '';

                switch(strtolower($category->category_name)) {
                    case 'news':
                        $categoryColor = 'bg-[#e94560]';
                        $categoryHoverColor = 'hover:bg-[#c2364e]';
                        break;
                    case 'podcast':
                        $categoryColor = 'bg-[#4285F4]';
                        $categoryHoverColor = 'hover:bg-[#3367D6]';
                        break;
                    case 'review':
                        $categoryColor = 'bg-[#FFD700] text-black';
                        $categoryHoverColor = 'hover:bg-[#E0B300]';
                        break;
                    case 'coverage':
                        $categoryColor = 'bg-[#FF9800]';
                        $categoryHoverColor = 'hover:bg-[#F57C00]';
                        break;
                    case 'interview':
                        $categoryColor = 'bg-[#4CAF50]';
                        $categoryHoverColor = 'hover:bg-[#388E3C]';
                        break;
                    case 'commentary':
                        $categoryColor = 'bg-[#9C27B0]';
                        $categoryHoverColor = 'hover:bg-[#7B1FA2]';
                        break;
                    default:
                        $categoryColor = 'bg-gray-500';
                        $categoryHoverColor = 'hover:bg-gray-300 text-black';
                        break;
                }
            @endphp

            <a href="{{ route('post.index', ['category' => $category->category_name]) }}"
               class="block text-center text-white font-bold py-3 px-6 rounded-lg transition duration-200 {{ $categoryColor }} {{ $categoryHoverColor }}">
                {{ $category->category_name }}
            </a>
        @endforeach
    </div>
</div>
