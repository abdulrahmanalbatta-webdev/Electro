<x-layout>
    <h1 class="h3 mb-4 text-gray-800">{{ __('Roles') }}</h1>
    <div class="card">
        <div class="card-body text-black">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Permissions') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roles as $role)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                @foreach ($role->permissions as $permission)
                                    <span class="badge bg-primary text-white">{{ $permission->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('roles.edit', $role) }}"
                                    class="btn btn-sm btn-primary d-flex align-items-center justify-content-center ml-2"
                                    title="Edit">
                                    <i class="fas fa-edit"></i></a>


                                <form id="myForm" action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                    class="m-0 p-0">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="confirmDelete({{ $role->id }})" type="button"
                                        class="btn btn-sm btn-danger d-flex align-items-center justify-content-center"
                                        title="Delete">
                                        <i class="fas fa-trash"></i></button>
                                </form>

                            </td>

                        @empty
                            <td class="text-center" colspan="6">{{ __('No roles') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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
