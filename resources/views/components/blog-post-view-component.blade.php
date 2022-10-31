<div>
    <div class="relative px-4 sm:px-6 lg:px-8" style="min-height: 75vh">
        <div class="mx-auto max-w-prose text-lg">
            <h1>
                <span class="block text-center text-lg font-semibold text-blue-600">


                    @foreach ($post->category as $postCategory)
                        <a href="{{ route('blog.index', ['category' => $postCategory->id]) }}"
                            class="hover:underline">{{ $postCategory->name }}</a>
                    @endforeach
                </span>
                <span
                    class="mt-2 block text-center text-3xl font-bold leading-8 tracking-tight text-gray-900 sm:text-4xl">{{ $post->title }}</span>
            </h1>
            <p class="mt-8 text-xl leading-8 text-gray-500"> {{ $post->description }}</p>
        </div>
        {{-- <div class="prose prose-lg prose-blue mx-auto mt-6 text-gray-500">

        </div> --}}
    </div>

</div>
