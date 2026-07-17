@extends('layout.Frontend')

@section('content')
<!-- Custom Styles for Hover Effects and Image Sizing -->
<style>
    .product-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 12px;
        overflow: hidden;
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important;
    }
    .product-img {
        height: 220px;
        object-fit: cover;
        width: 100%;
    }
    .search-container {
        max-width: 600px;
        margin: 0 auto;
    }
</style>

<div class="container py-5">

    <!-- Search Section -->
    <div class="row mb-5">
        <div class="col-12 search-container text-center">
            <h2 class="mb-4 fw-bold text-secondary">Find Your Products</h2>
            <form action="{{ url('/search') }}" method="GET" class="shadow-sm rounded">
                <div class="input-group input-group-lg">
                    <input type="text" name="keyword" value="{{ $keyword ?? '' }}" class="form-control border-end-0" placeholder="Search for products..." aria-label="Search">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-search"></i> Search
                    </button>
                </div>
            </form>
            @if(isset($keyword) && $keyword != '')
                <p class="text-muted mt-3">Showing results for: <strong>"{{ $keyword }}"</strong></p>
            @endif
        </div>
    </div>

    <!-- Product Grid -->
    <div class="row g-4 mb-5">
        @forelse($products as $product)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 shadow-sm border-0 product-card">
                    <!-- Product Image -->
                    <a href="{{ url('/show/'.$product->id) }}">
                        <img src="{{ asset('img/' . $product->image) }}" class="card-img-top product-img" alt="{{ $product->name }}">
                    </a>

                    <!-- Product Details -->
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">
                            <a href="{{ url('/show/'.$product->id) }}" class="text-decoration-none text-dark">
                                {{ $product->name }}
                            </a>
                        </h5>
                        <p class="card-text text-muted small flex-grow-1">
                            {{ Str::limit($product->description, 60, '...') }}
                        </p>

                        <!-- Price & Action -->
                        <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                            <span class="fs-5 fw-bold text-primary">${{ number_format($product->price, 2) }}</span>
                            <a href="#" class="btn btn-warning rounded-pill px-3 shadow-sm">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <!-- Empty State -->
            <div class="col-12 text-center py-5">
                <h4 class="text-muted">No products found matching your search.</h4>
                <a href="{{ url('/search') }}" class="btn btn-outline-primary mt-3">Clear Search</a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
    </div>

</div>
@endsection
