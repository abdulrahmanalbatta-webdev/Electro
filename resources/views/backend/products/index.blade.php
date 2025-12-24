<x-layout>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ __('Products') }}</h1>

    <a href="{{ route('products.index', ['status' => 'trashed']) }}" class="btn btn-primary">
        <i class="fas fa-trash-alt me-1"></i> {{ __('Trashed Products') }}
    </a>
</div>


    <div class="card mb-4">
        <div class="card-body">

            <!-- Filters Form -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" class="row g-3 align-items-end">

                        <!-- Status Filter -->
                        <div class="col-6 col-md-2">
                            <label for="status" class="form-label fw-bold">{{ __('Status') }}</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">{{ __('All') }}</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>
                                    {{ __('Active') }}</option>
                                <option value="trashed" {{ request('status') == 'trashed' ? 'selected' : '' }}>
                                    {{ __('Trashed') }}</option>
                            </select>
                        </div>

                        <!-- Category Filter -->
                        <div class="col-6 col-md-2">
                            <label for="category_id" class="form-label fw-bold">{{ __('Category') }}</label>
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="">{{ __('All Categories') }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->trans_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Start Date -->
                        <div class="col-6 col-md-2">
                            <label for="start_date" class="form-label fw-bold">{{ __('Start Date') }}</label>
                            <input type="date" name="start_date" id="start_date" class="form-control"
                                value="{{ request('start_date') }}">
                        </div>

                        <!-- End Date -->
                        <div class="col-6 col-md-2">
                            <label for="end_date" class="form-label fw-bold">{{ __('End Date') }}</label>
                            <input type="date" name="end_date" id="end_date" class="form-control"
                                value="{{ request('end_date') }}">
                        </div>

                        <!-- Search -->
                        <div class="col-12 col-md-2">
                            <label for="search" class="form-label fw-bold">{{ __('Product Name') }}</label>
                            <input type="text" name="search" id="search" class="form-control"
                                placeholder="{{ __('Search by name') }}" value="{{ request('search') }}">
                        </div>

                    <!-- Submit Buttons -->
                    <div class="col-12 col-md-2">
                        <!-- Filter Button -->
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter me-1"></i>
                        </button>

                        <!-- Reset Button -->
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-undo me-1"></i>
                        </a>
                    </div>


                    </form>
                </div>
            </div>


            <!-- Products Table -->
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
                            {{-- <th>{{ __('Created By') }}</th> --}}
                            {{-- <th>{{ __('Updated By') }}</th> --}}
                            {{-- <th>{{ __('Deleted By') }}</th> --}}
                            {{-- <th>{{ __('Created At') }}</th> --}}
                            {{-- <th>{{ __('Updated At') }}</th> --}}
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->trans_name }}</td>
                                <td><img src="{{ $product->img_path }}" width="80"></td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->category->trans_name ?? '-' }}</td>
                                {{-- <td>{{ $product->createdBy->name ?? '-' }}</td>
                                <td>{{ $product->updatedBy->name ?? '-' }}</td>
                                <td>{{ $product->deletedBy->name ?? '-' }}</td>
                                <td>{{ $product->created_at->diffForHumans() }}</td>
                                <td>{{ $product->updated_at->diffForHumans() }}</td> --}}
                                <td class="actions">
                                    <!-- Show -->
                                    <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-info"
                                        title="{{ __('Show') }}">
                                       <i class="fas fa-info-circle"></i>
                                    </a>

                                    <!-- Edit -->
                                    <a href="{{ route('products.edit', $product) }}"
                                        class="btn btn-sm btn-primary" title="{{ __('Edit') }}">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form id="delete-form-{{ $product->id }}"
                                        action="{{ route('products.destroy', $product->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="confirmDelete({{ $product->id }})" type="button"
                                            class="btn btn-sm btn-danger" title="{{ __('Delete') }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-center">{{ __('No products found') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $products->links() }}

        </div>
    </div>

    @push('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function confirmDelete(id) {
                Swal.fire({
                    title: "{{ __('Are you sure?') }}",
                    text: "{{ __('You won\'t be able to revert this!') }}",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "{{ __('Yes, delete it!') }}",
                    cancelButtonText: "{{ __('Cancel') }}"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            }
        </script>
    @endpush
</x-layout>
