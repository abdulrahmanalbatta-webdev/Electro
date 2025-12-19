<x-layout>
    <h1 class="h3 mb-4 text-gray-800">{{ __('Users') }}</h1>
    <div class="card">
        <div class="card-body text-black">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Type') }}</th>
                        <th>{{ __('Created At') }}</th>
                        <th>{{ __('Updated At') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            @php
                                if (isset($user->image->path)) {
                                    $src = asset('images/' . $user->image->path);
                                } else {
                                    $src =
                                        'https://ui-avatars.com/api/?name=' .
                                        urlencode($user->name) .
                                        '&background=random&size=128';
                                }
                            @endphp
                            <td><img src="{{ $src }}" alt="user-photo"
                                    style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;"></td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->type }}</td>
                            <td>{{ $user->created_at->diffForHumans() }}</td>
                            <td>{{ $user->updated_at->diffForHumans() }}</td>
                            <td class="actions">
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form id="delete-form-{{ $user->id }}"
                                    action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="confirmDelete({{ $user->id }})" type="button"
                                        class="btn btn-sm btn-danger mx-1" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        @empty
                            <td class="text-center" colspan="6">{{ __('No users') }}</td>
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
