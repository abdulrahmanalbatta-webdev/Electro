<x-layout>
    <h1 class="h3 mb-4 text-gray-800">{{ __('Payments') }}</h1>
    <div class="card">
        <div class="card-body text-black">
            <div class="table-responsive">
                <table class="table table-bpaymented table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Customer') }}</th>
                            <th>{{ __('Total') }}</th>
                            <th>{{ __('Created At') }}</th>
                            <th>{{ __('Updated At') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($payments as $payment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $payment->user_id }}</td>
                                <td>{{ $payment->total }}</td>
                                <td>{{ $payment->created_at->diffForHumans() }}</td>
                                <td>{{ $payment->updated_at->diffForHumans() }}</td>
                                <td class="actions">
                                    <a href="{{ route('categories.edit', $payment) }}"
                                        class="btn btn-sm btn-primary mx-1" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('categories.destroy', $payment->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger mx-1" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>

                            @empty
                                <td class="text-center" colspan="7">{{ __('No payments') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
