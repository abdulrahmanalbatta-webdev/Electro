<x-layout>
    <h1 class="h3 mb-4 text-gray-800">{{ __('Categories') }}</h1>
    <div class="card">
        <div class="card-body text-black">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Name') }}</th>
                            {{-- <th>{{ __('Image') }}</th> --}}
                            <th>{{ __('Description') }}</th>
                            <th>{{ __('Products Count') }}</th>
                            <th>{{ __('Created At') }}</th>
                            <th>{{ __('Updated At') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->trans_name }}</td>
                                {{-- <td><img src="{{ $category->img_path }}" alt="" width="80"></td> --}}
                                <td>{{ $category->trans_description }}</td>
                                <td>{{ $category->products->count() }}</td>
                                <td>{{ $category->created_at->diffForHumans() }}</td>
                                <td>{{ $category->updated_at->diffForHumans() }}</td>
                                <td class="actions">
                                    <a href="{{ route('categories.edit', $category) }}"
                                        class="btn btn-sm btn-primary mx-1" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form id="delete-form-{{ $category->id }}" action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="confirmDelete({{$category->id}})" type="button"
                                            class="btn btn-sm btn-danger mx-1" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>

                            @empty
                                <td class="text-center" colspan="7">{{ __('No Categories') }}</td>
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
