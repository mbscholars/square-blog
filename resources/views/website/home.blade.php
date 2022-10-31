@extends('layouts.website')

@section('content')
    <div class="relative bg-white px-4 pt-16 pb-20 sm:px-6 lg:px-8 lg:pt-24 lg:pb-28">
        <div class="absolute inset-0">
            <div class="h-1/3 bg-white sm:h-2/3"></div>
        </div>
        <div class="relative mx-auto max-w-7xl">
            <div class="text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Welcome to our blog</h2>
                <p class="mx-auto mt-3 max-w-2xl text-xl text-gray-500 sm:mt-4">Showing recent contents from the blog.</p>
            </div>
            <div class="mx-auto mt-12 grid max-w-lg gap-5 lg:max-w-none lg:grid-cols-3">

                @foreach ($posts as $post)
                    <x-post-card-item-component :post="$post" />
                @endforeach

            </div>
            <div class="navigation my-8">

                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
