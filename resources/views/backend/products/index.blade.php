<x-layout>
    <h1 class="h3 mb-4 text-gray-800">{{ __('Products') }}</h1>
    <div class="card">
        <div class="card-body text-black">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Image') }}</th>
                            <th>{{ __('Price') }}</th>
                            <th>{{ __('Quantity') }}</th>
                            <th>{{ __('Category') }}</th>
                            <th>{{ __('Created At') }}</th>
                            <th>{{ __('Updated At') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->trans_name }}</td>
                                <td><img src="{{ $product->img_path }}" alt="" width="80"></td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->category->trans_name }}</td>
                                <td>{{ $product->created_at->diffForHumans() }}</td>
                                <td>{{ $product->updated_at->diffForHumans() }}</td>
                                <td class="actions">
                                    <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-primary mx-1"
                                        title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form id="delete-form-{{$product->id}}" action="{{ route('products.destroy', $product->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="confirmDelete({{$product->id}})" type="button" class="btn btn-sm btn-danger mx-1" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>

                            @empty
                                <td class="text-center" colspan="10">{{ __('No products') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @push('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function confirmDelete(id) {
                Swal.fire({
                    title: "{{__('Are you sure?')}}",
                    text: "{{__('You wont be able to revert this!')}}",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "{{__('Yes, delete it!')}}",
                    cancelButtonText: "{{__('Cancel')}}"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "{{__('Deleted!')}}",
                            text: "{{__('Your file has been deleted.')}}",
                            icon: "success"
                        });
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            }
        </script>
    @endpush
</x-layout>
