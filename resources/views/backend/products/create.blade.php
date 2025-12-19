<x-layout>
    <h1 class="h3 mb-4 text-gray-800">{{ __('Add New Product') }}</h1>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="row">
                                    <div class="col-md-6">
                                        <x-input type="text" name="name_en" label="{{ __('English Name') }}"
                                            placeholder="{{ __('Enter english name') }}" />
                                    </div>
                                    <div class="col-md-6">
                                        <x-input type="text" name="name_ar" label="{{ __('Arabic Name') }}"
                                            placeholder="{{ __('Enter arabic name') }}" />
                                    </div>
                                </div>

                                <x-textarea name="description_en" label="{{ __('English Description') }}"
                                    placeholder="{{ __('Enter english description') }}" />
                                <x-textarea name="description_ar" label="{{ __('Arabic Description') }}"
                                    placeholder="{{ __('Enter arabic description') }}" />
                                <div class="row">
                                    <div class="col-md-6">
                                        <x-input type="number" name="price" label="{{ __('Price') }}"
                                            placeholder="{{ __('Enter price') }}" />
                                    </div>
                                    <div class="col-md-6">
                                        <x-input type="number" name="quantity" label="{{ __('Quantity') }}"
                                            placeholder="{{ __('Enter quantity') }}" />
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label>{{ __('Category') }}</label>
                                    <select name="category_id"
                                        class="form-control @error('category') is-invalid @enderror">
                                        <option value="" disabled selected>{{ __('Select category') }}</option>
                                        @forelse ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->trans_name }}</option>
                                        @empty
                                            <option value="">No categories</option>
                                        @endforelse
                                    </select>
                                    @error('category')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <!-- Main Image -->
                                <div class="text-center mb-3">
                                    <img id="imagePreview" src="" class="img-fluid rounded mb-2"
                                        style="max-height: 150px;">
                                </div>

                                <x-input type="file" name="image" id="imageInput"
                                    label="{{ __('Upload Image') }}" />

                                <!-- Gallery -->
                                <div class="text-center mb-3">
                                    <img id="galleryPreview" src="" class="img-fluid rounded mb-2"
                                        style="max-height: 150px;">
                                </div>

                                <x-input type="file" name="gallery[]" multiple label="{{ __('Upload Gallery') }}" />
                            </div>
                        </div>

                        <button class="btn btn-primary mt-3">{{ __('Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @push('js')
        <script>
            const imageInput = document.querySelector('input[name="image"]');
            const imagePreview = document.getElementById('imagePreview');

            if (imageInput) {
                imageInput.addEventListener('change', function(e) {
                    const [file] = e.target.files;
                    if (file) {
                        imagePreview.src = URL.createObjectURL(file);
                    }
                });
            }
        </script>
    @endpush
</x-layout>
