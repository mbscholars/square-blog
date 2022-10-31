<div class="flex flex-col overflow-hidden rounded-lg shadow-lg">
    <div class="flex-shrink-0">
        <img class="h-48 w-full object-cover"
            src="https://images.unsplash.com/photo-1496128858413-b36217c2ce36?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1679&q=80"
            alt="">
    </div>
    <div class="flex flex-1 flex-col justify-between bg-white p-6">
        <div class="flex-1">
            <p class="text-sm font-medium text-blue-600">
                @foreach ($post->category as $postCategory)
                    <a href="{{ route('blog.index', ['category' => $postCategory->id]) }}"
                        class="hover:underline">{{ $postCategory->name }}</a>
                @endforeach

            </p>
            <a href="{{ route('blog.show', ['slug' => $post->slug]) }}" class="mt-2 block">
                <p class="text-xl font-semibold text-gray-900">{{ $post->title }}</p>
                {{-- <p class="mt-3 text-base text-gray-500">{{ $post->excerpt }}</p> --}}
            </a>
        </div>
        <div class="mt-6 flex items-center">
            <div class="flex-shrink-0">
                <a href="#">
                    <span class="sr-only">{{ optional($post->author)->name }}</span>
                    <img class="h-10 w-10 rounded-full" src="https://i.pravatar.cc/256?img=70" alt="">
                </a>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-gray-900">
                    <a href="#" class="hover:underline">{{ optional($post->author)->name }}</a>
                </p>
                <div class="flex space-x-1 text-sm text-gray-500">
                    <time datetime="2020-03-16">{{ $post->created_at->format('d M, Y') }}</time>
                    {{-- <span aria-hidden="true">&middot;</span> --}}

                </div>
            </div>
        </div>
    </div>
</div>
