@extends('layouts.dashboard')


@push('head-scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/35.2.1/classic/ckeditor.js"></script>
@endpush

@section('content')
    <div class="bg-gray-50">
        <div class="mx-auto max-w-2xl px-4 pt-16 pb-24 sm:px-6 lg:max-w-7xl lg:px-8">
            <h2 class="sr-only">Checkout</h2>

            <form class="lg:grid lg:grid-cols-1 lg:gap-x-12 xl:gap-x-16" method="POST" action="{{ route('dashboard.store') }}"
                id='postForm' name="postForm">
                @csrf
                <input type="hidden" name="status" value="published">
                <div>
                    <div x-data="{ category: '' }">
                        <h2 class="text-lg font-medium text-gray-900">Create New Post</h2>

                        <div class="mt-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Post Title </label>
                            <div class="mt-1">
                                <input type="title" id="title" name="title" autocomplete="title"
                                    class="form-control @error('title') is-invalid @enderror">
                            </div>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mt-4">

                            <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                            <div class="mt-1">
                                <select id="category_id" x-model="category" name="category_id" autocomplete="category-name"
                                    class="form-control @error('category_id') is-invalid @enderror">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                    {{-- <option value="0">New Category</option> --}}

                                </select>
                            </div>
                            @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="mt-4" x-show="category == '0'">
                            <label for="category" class="block text-sm font-medium text-gray-700">Enter Category Name
                            </label>
                            <div class="mt-1">
                                <input type="text" id="category" name="category" autocomplete="category"
                                    class="form-control @error('category') is-invalid @enderror">
                            </div>
                            @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mt-4 ">
                            <label for="category" class="block text-sm font-medium text-gray-700">Post Content
                            </label>
                            <textarea name="description" rows="12" id="description"
                                class="form-control  @error('description') is-invalid @enderror">{{ old('description') ?? 'Enter text here' }}</textarea>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                    <div class="border-t  border-gray-200 py-6" x-data="{ loading: false }">
                        <input type="submit" id="submit" x-bind:disabled="loading"
                            x-bind:class="loading == true ? 'loading_btn' : 'create_post_btn'" value="Create  Post" />
                    </div>
                </div>


            </form>
        </div>
    </div>
@endsection

@push('custom-scripts')
    <script>
        // ClassicEditor
        //     .create(document.querySelector('#description'))

        //     .catch(error => {
        //         console.error(error);
        //     });
    </script>
@endpush
