<x-layout>
    <h1 class="h3 mb-4 text-gray-800">{{ __('Permissions') }}</h1>
    <div class="card">
        <div class="card-body text-black">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        {{-- <th>Image</th> --}}
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Created At') }}</th>
                        <th>{{ __('Updated At') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($permissions as $permission)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->created_at->diffForHumans() }}</td>
                            <td>{{ $permission->updated_at->diffForHumans() }}</td>
                            <td class="actions d-flex align-items-center gap-2">
                                <div>
                                    <a href="{{ route('permissions.edit', $permission) }}"
                                        class="btn btn-sm btn-primary d-flex align-items-center justify-content-center ml-2"
                                        title="Edit">
                                        <i class="fas fa-edit"></i></a>
                                </div>
                                <div>
                                    <form id="delete-form-{{$permission->id}}" action="{{ route('permissions.destroy', $permission->id) }}"
                                        method="POST" class="m-0 p-0">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="confirmDelete({{$permission->id}})" type="button"
                                            class="btn btn-sm btn-danger d-flex align-items-center justify-content-center"
                                            title="Delete">
                                            <i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        @empty
                            <td class="text-center" colspan="6">{{ __('No permissions') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $permissions->links() }}
            </div>

        </div>
    </div>
    @push('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function confirmDelete(id) {
                Swal.fire({
                    title: "{{ __('Are you sure?') }}",
                    text: "{{ __('You wont be able to revert this!') }}",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "{{ __('Yes, delete it!') }}",
                    cancelButtonText: "{{ __('Cancel') }}"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "{{ __('Deleted!') }}",
                            text: "{{ __('Your file has been deleted.') }}",
                            icon: "success"
                        });
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            }
        </script>
    @endpush
</x-layout>
