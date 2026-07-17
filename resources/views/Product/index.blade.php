@extends('layout.Backend')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Product List</h1>
        <a class="btn btn-primary shadow-sm" href="{{ url('/product/create') }}">
            <i class="bi bi-plus-lg"></i> Add New Product
        </a>
    </div>

    @if(Session::has('product_delete'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <strong>Success!</strong> {{ session('product_delete') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if (count($products) > 0)
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Products</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="myTable" class="table table-hover table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th class="text-center" style="width: 150px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td class="fw-bold">
                                <a href="{{ url('/product/'.$product->id) }}" class="text-decoration-none">
                                    {{ $product->name }}
                                </a>
                            </td>
                            <td>
                                {!! Str::limit(strip_tags($product->description), 50, '...') !!}
                            </td>
                            <td>
                                <img src="{{ asset('img/'.$product->image) }}" alt="{{ $product->name }}" class="img-thumbnail" style="width: 75px; height: 75px; object-fit: cover;">
                            </td>
                            <td class="text-success fw-bold">
                                ${{ number_format($product->price, 2) }}
                            </td>

                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a class="btn btn-sm btn-outline-primary" href="{{ url('product/' . $product->id . '/edit') }}">
                                        Edit
                                    </a>

                                    {{ Html::form('DELETE', 'product/'. $product->id)->open() }}
                                        <button type="button" class="btn btn-sm btn-outline-danger delete-btn">
                                            Delete
                                        </button>
                                    {{ Html::form()->close() }}
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize DataTable
            if (typeof DataTable !== 'undefined') {
                new DataTable('#myTable');
            }

            // Modern, lightweight delete confirmation
            const deleteButtons = document.querySelectorAll('.delete-btn');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = this.closest('form');

                    // Using native browser confirmation instead of heavy jQuery UI
                    if (confirm('Are you sure you want to delete this product? This action cannot be undone.')) {
                        form.submit();
                    }
                });
            });
        });
    </script>

    @else
        <div class="card shadow-sm border-0 py-5 text-center">
            <div class="card-body">
                <h4 class="text-muted mb-3">No products found</h4>
                <p class="text-muted">Get started by creating your first product.</p>
                <a class="btn btn-primary" href="{{ url('/product/create') }}">Create Product</a>
            </div>
        </div>
    @endif
</div>
@endsection
