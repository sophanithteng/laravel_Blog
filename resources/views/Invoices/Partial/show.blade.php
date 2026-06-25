@extends('layout.Backend')
@section('content')

    <div class="card">
        <div class="card-header">
            <h1>Invoice Details</h1>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Invoice ID:</strong> {{ $invoice->id }}</li>
                <li class="list-group-item"><strong>Client Name:</strong> {{ $invoice->client_name }}</li>
                <li class="list-group-item"><strong>Issue Date:</strong> {{ $invoice->issue_date }}</li>
                <li class="list-group-item"><strong>Due Date:</strong> {{ $invoice->due_date }}</li>
                <li class="list-group-item"><strong>Balance Due:</strong> ${{ number_format($invoice->balance_due, 2) }}</li>
                <li class="list-group-item"><strong>Created At:</strong> {{ $invoice->created_at }}</li>
                <li class="list-group-item"><strong>Last Updated:</strong> {{ $invoice->updated_at }}</li>
            </ul>
        </div>
        <div class="card-footer">
            <a href="{{ route('invoices.index') }}" class="btn btn-secondary">Back to List</a>
            <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-warning">Edit Invoice</a>
        </div>
    </div>
@endsection
