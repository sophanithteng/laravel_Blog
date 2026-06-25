@extends('layout.Backend')
@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>All Invoices</h1>
        <a href="{{ route('invoices.create') }}" class="btn btn-primary">Create New Invoice</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th>Client Name</th>
                <th>Issue Date</th>
                <th>Due Date</th>
                <th>Balance Due</th>
                <th style="width: 150px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->id }}</td>
                    <td>{{ $invoice->client_name }}</td>
                    <td>{{ $invoice->issue_date }}</td>
                    <td>{{ $invoice->due_date }}</td>
                    <td>${{ number_format($invoice->balance_due, 2) }}</td>
                    <td class="text-center">
                        <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No invoices found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
