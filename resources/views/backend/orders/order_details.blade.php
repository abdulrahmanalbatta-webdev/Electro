<x-layout>
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-4 text-gray-800">{{ __('Order Details') }}</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">{{ __('Back to Orders') }}</a>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Order Details') }}</h6>
        </div>
        <div class="card-body">


            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong>{{ __('Order ID') }}:</strong> {{ $order->id }}</p>
                    <p><strong>{{ __('Customer') }}:</strong> {{ $order->user->name }}</p>
                    <p><strong>{{ __('Email') }}:</strong> {{ $order->user->email }}</p>
                    <p><strong>{{ __('Status') }}:</strong>
                        <select onchange="change_status(event, {{ $order->id }})" class="form-control"
                            name="status" id="status">
                            <option value="pending" @selected('pending' === $order->status)>pending</option>
                            <option value="processing" @selected('processing' === $order->status)>processing</option>
                            <option value="shipped" @selected('shipped' === $order->status)>shipped</option>
                            <option value="delivered" @selected('delivered' === $order->status)>delivered</option>
                            <option value="cancelled" @selected('cancelled' === $order->status)>cancelled</option>
                        </select>
                    </p>
                </div>
                <div class="col-md-6">
                    <p><strong>{{ __('Total') }}:</strong> ${{ number_format($order->total, 2) }}</p>
                    <p><strong>{{ __('Created At') }}:</strong> {{ $order->created_at->format('d M Y, H:i') }}</p>
                    <p><strong>{{ __('Updated At') }}:</strong> {{ $order->updated_at->format('d M Y, H:i') }}</p>
                </div>
            </div>


            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('Product') }}</th>
                            <th>{{ __('Quantity') }}</th>
                            <th>{{ __('Price') }}</th>
                            <th>{{ __('Subtotal') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($order->order_items as $item)
                            <tr>
                                <td>{{ $item->product->trans_name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>${{ number_format($item->price, 2) }}</td>
                                <td>${{ number_format($item->quantity * $item->price, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">{{ __('No items found') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>


    {{-- <div class="card mt-4">
        <div class="card-header">
            <h5 class="card-title">{{ __('Order Items') }}</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>{{ __('Product') }}</th>
                            <th>{{ __('Quantity') }}</th>
                            <th>{{ __('Price') }}</th>
                            <th>{{ __('Total') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($order->order_items as $item)
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>${{ number_format($item->price, 2) }}</td>
                                <td>${{ number_format($item->quantity * $item->price, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">{{ __('No items found') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div> --}}

    @push('js')
        <script>
            function change_status(e, order_id) {
                let status = e.target.value;

                fetch(`{{ url('/change_status') }}/${order_id}/${status}`)
                    .then(res => res.json())
                    .then(data => console.log(data))
                    .catch(err => console.error(err));
            }
        </script>
    @endpush
</x-layout>
