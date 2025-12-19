<x-layout>
    @push('css')
        <style>
            .img-pre {
                width: 100%;
                height: 150px;
                object-fit: cover;
            }
        </style>
    @endpush
    <h1 class="h3 mb-4 text-gray-800">{{ __('Edit Product') }}</h1>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('products.update', $product->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="row">
                                    <div class="col-md-6">
                                        <x-input type="text" name="name_en" label="{{ __('English Name') }}"
                                            placeholder="{{ __('Enter english name') }}" :oldValue="$product->trans_name_en" />
                                    </div>
                                    <div class="col-md-6">
                                        <x-input type="text" name="name_ar" label="{{ __('Arabic Name') }}"
                                            placeholder="{{ __('Enter arabic name') }}" :oldValue="$product->trans_name_ar" />
                                    </div>
                                </div>

                                <x-textarea name="description_en" label="{{ __('English Description') }}"
                                    placeholder="{{ __('Enter english description') }}" :oldValue="$product->trans_description_en" />
                                <x-textarea name="description_ar" label="{{ __('Arabic Description') }}"
                                    placeholder="{{ __('Enter arabic description') }}" :oldValue="$product->trans_description_ar" />
                                <div class="row">
                                    <div class="col-md-6">
                                        <x-input type="number" name="price" label="{{ __('Price') }}"
                                            placeholder="{{ __('Enter price') }}" :oldValue="$product->price" />
                                    </div>
                                    <div class="col-md-6">
                                        <x-input type="number" name="quantity" label="{{ __('Quantity') }}"
                                            placeholder="{{ __('Enter quantity') }}" :oldValue="$product->quantity" />
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label>Category</label>
                                    <select name="category_id"
                                        class="form-control @error('category') is-invalid @enderror">
                                        <option value="" disabled selected>Select category</option>
                                        @forelse ($categories as $category)
                                            <option value="{{ $category->id }}" @selected($category->id === $product->category->id)>
                                                {{ $category->trans_name }}</option>
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
                                    <img id="imagePreview" src="{{ asset('images/' . $product->image->path) }}"
                                        class="img-pre img-fluid rounded mb-2">
                                </div>

                                <x-input type="file" name="image" id="imageInput"
                                    label="{{ __('Upload Image') }}" />

                                <!-- Gallery -->
                                <div class="text-center mb-3">
                                    <div class="row g-3 gallery-wrapper">

                                        @foreach ($product->gallery as $img)
                                            <div class="col-6 position-relative">


                                                <button onclick="deleteImg(event, {{ $img->id }})" type="button"
                                                    class="btn btn-danger btn-sm position-absolute top-0 end-0 translate-middle d-flex justify-content-center align-items-center"
                                                    style="width: 24px; height: 24px; padding: 0;">
                                                            <i class="fa-solid fa-xmark"></i>
                                                </button>



                                                <img src="{{ asset('images/' . $img->path) }}"
                                                    class="img-fluid rounded shadow-sm img-pre mb-2">
                                            </div>
                                        @endforeach

                                    </div>
                                </div>



                                <x-input type="file" name="gallery[]" multiple label="{{ __('Upload Gallery') }}" />
                            </div>
                        </div>

                        <button class="btn btn-primary mt-3">{{ __('Update') }}</button>
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

            //

            function deleteImg(e, id) {
                fetch('{{ route('delete_image') }}/' + id)
                    .then(res => res.text())
                    .then(data => {
                        console.log(data);

                        if (data) {
                            e.target.closest('div').remove();
                        }
                    })
                    .catch(err => console.error(err));
            }
        </script>
    @endpush
</x-layout>
