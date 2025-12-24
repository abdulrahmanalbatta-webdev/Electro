<x-layout>
    <h1 class="h3 mb-4 text-gray-800">{{ __('Product Details') }}</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row g-3">

                <!-- Image -->
                <div class="col-md-4 text-center">
                    <img src="{{ $product->img_path }}" alt="{{ $product->trans_name }}" class="img-fluid rounded mb-3">
                </div>

                <!-- Details -->
                <div class="col-md-8">
                    <table class="table table-borderless">
                        <tr>
                            <th>{{ __('Name') }}:</th>
                            <td>{{ $product->trans_name }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Price') }}:</th>
                            <td>${{ number_format($product->price, 2) }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Quantity') }}:</th>
                            <td>{{ $product->quantity }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Category') }}:</th>
                            <td>{{ $product->category->trans_name }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Created By') }}:</th>
                            <td>{{ $product->createdBy->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Updated By') }}:</th>
                            <td>{{ $product->updatedBy->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Deleted By') }}:</th>
                            <td>{{ $product->deletedBy->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Created At') }}:</th>
                            <td>{{ $product->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Updated At') }}:</th>
                            <td>{{ $product->updated_at->format('d M Y H:i') }}</td>
                        </tr>
                        @if($product->deleted_at)
                        <tr>
                            <th>{{ __('Deleted At') }}:</th>
                            <td>{{ $product->deleted_at->format('d M Y H:i') }}</td>
                        </tr>
                        @endif
                    </table>

                    <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">{{ __('Back to Products') }}</a>
                </div>
            </div>
        </div>
    </div>
</x-layout>
