@extends('layout.Frontend')

@section('content')
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
    /* Smooth transition for category pills */
    .category-pill {
        transition: all 0.2s ease-in-out;
    }
</style>

<div class="container py-5">

    @if(isset($categories) && $categories->isNotEmpty())
        <div class="row mb-5">
            <div class="col-12">
                <div class="d-flex flex-wrap justify-content-center gap-2">
                    <a href="{{ url('/') }}" class="btn btn-outline-secondary rounded-pill px-4 category-pill">
                        All Products
                    </a>

                    @foreach ($categories as $category)
                        <a href="{{ url('/frontend/'.$category->id) }}" class="btn btn-outline-primary rounded-pill px-4 category-pill">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <div class="row g-4 mb-5">
        @forelse($products as $product)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 shadow-sm border-0 product-card">
                    <a href="{{ url('/show/'.$product->id) }}">
                        <img src="{{ asset('img/' . $product->image) }}" class="card-img-top product-img" alt="{{ $product->name }}">
                    </a>

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">
                            <a href="{{ url('/show/'.$product->id) }}" class="text-decoration-none text-dark">
                                {{ $product->name }}
                            </a>
                        </h5>
                        <p class="card-text text-muted small flex-grow-1">
                            {{ Str::limit($product->description, 60, '...') }}
                        </p>

                        <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                            <span class="fs-5 fw-bold text-primary">${{ number_format($product->price, 2) }}</span>
                            <a href="#" class="btn btn-warning rounded-pill px-3 shadow-sm">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <h4 class="text-muted">No products found in this category.</h4>
                <a href="{{ url('/') }}" class="btn btn-outline-primary mt-3">View All Products</a>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>

</div>
@endsection
