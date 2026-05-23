@extends('include.templat.main_page')

@section('title', 'Sales History')

@section('contact')
<style>
    .container{
        margin-top: 30px
    }
</style>


  <div class="container">
    <a class="btn btn-light fw-bold" href="{{ route('index') }}">
      💰 Pharmacy POS
    </a>


  </div>





<div class="container py-4">
    <h2 class="mb-4 text-center">📜 Sales History</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead class="table-success">
            <tr>
                <th>#</th>
                <th>Cashier</th>
                <th>Date</th>
                <th>Total (EGP)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sales as $sale)
                <tr>
                    <td>{{ $sale->id }}</td>
                    <td>{{ $sale->user->username ?? 'N/A' }}</td>
                    <td>{{ $sale->created_at->format('Y-m-d H:i') }}</td>
                    <td>{{ number_format($sale->total_amount, 2) }}</td>
                    <td>
                        <a href="{{ route('sales.show', $sale->id) }}" class="btn btn-sm btn-primary">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No sales found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $sales->links() }}
    </div>
</div>
@endsection
