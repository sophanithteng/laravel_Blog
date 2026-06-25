@extends('layout.Backend')
@section('content')

    <h1>Create New Invoice</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('invoices.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="client_name" class="form-label">Client Name:</label>
            <input type="text" name="client_name" id="client_name" class="form-control" value="{{ old('client_name') }}" required>
        </div>

        <div class="mb-3">
            <label for="issue_date" class="form-label">Issue Date:</label>
            <input type="date" name="issue_date" id="issue_date" class="form-control" value="{{ old('issue_date') }}" required>
        </div>

        <div class="mb-3">
            <label for="due_date" class="form-label">Due Date:</label>
            <input type="date" name="due_date" id="due_date" class="form-control" value="{{ old('due_date') }}" required>
        </div>

        <div class="mb-3">
            <label for="balance_due" class="form-label">Balance Due:</label>
            <input type="number" step="0.01" name="balance_due" id="balance_due" class="form-control" value="{{ old('balance_due') }}" required>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Save Invoice</button>
            <a href="{{ route('invoices.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
