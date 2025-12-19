<x-layout>
    <h1 class="h3 mb-4 text-gray-800">{{ __('Orders') }}</h1>
    <div class="card">
        <div class="card-body text-black">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Customer') }}</th>
                            <th>{{ __('Total') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Created At') }}</th>
                            <th>{{ __('Updated At') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->total }}</td>
                                <td>{{ $order->status }}</td>
                                <td>{{ $order->created_at->diffForHumans() }}</td>
                                <td>{{ $order->updated_at->diffForHumans() }}</td>
                                <td class="actions">
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-primary"
                                        title="Show Details">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger mx-1" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>

                            @empty
                                <td class="text-center" colspan="7">{{ __('No Orders') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
