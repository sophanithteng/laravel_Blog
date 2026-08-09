@extends('layout.Frontend')

@push('styles')
<style>
    .custom-product-card {
        border-radius: 28px;
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        background-color: #ffffff;
        overflow: hidden;
        padding: 12px;
    }

    .product-image-container {
        background-color: #f4f4f4;
        border-radius: 20px;
        position: relative;
        padding: 25px 15px;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .brand-pill {
        position: absolute;
        top: 15px;
        left: 15px;
        background-color: #ffffff;
        border-radius: 20px;
        padding: 5px 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .product-img {
        max-width: 100%;
        height: 180px;
        object-fit: contain;
        margin-bottom: 10px;
    }

    .carousel-indicators-custom {
        display: flex;
        gap: 6px;
        margin-top: auto;
    }

    .carousel-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: #cbd5e1;
    }

    .carousel-dot.active {
        background-color: #22c55e;
    }

    .product-details {
        padding: 15px 5px 5px 5px;
    }

    .badge-bestseller {
        background-color: #ecfdf5;
        color: #047857;
        font-weight: 600;
        font-size: 0.8rem;
        padding: 6px 12px;
        border-radius: 20px;
    }

    .icon-heart {
        color: #ef4444;
        font-size: 1.3rem;
        cursor: pointer;
    }

    .product-title {
        font-weight: 700;
        font-size: 1.15rem;
        color: #1f2937;
        margin: 15px 0;
        line-height: 1.4;
    }

    .price-label {
        font-size: 0.8rem;
        color: #6b7280;
        margin-bottom: 2px;
    }

    .price-amount {
        font-size: 1.25rem;
        font-weight: 700;
        color: #047857;
    }

    .btn-buy-now {
        background-color: #27272a;
        color: #ffffff;
        border-radius: 30px;
        padding: 12px 30px;
        font-weight: 600;
        border: none;
        transition: all 0.2s ease;
    }

    .btn-buy-now:hover {
        background-color: #000000;
        color: #ffffff;
    }
</style>
@endpush

@section('content')
<div class="container-fluid mt-4">
    <!-- Category filter -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <a href="{{ route('home') }}" class="btn btn-primary m-1">
                <i class="fas fa-layer-group mr-1"></i> All
            </a>
            @foreach($categories as $category)
                <a href="{{ url('/frontend/category/' . $category->id) }}" class="btn btn-default m-1">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>

    <!-- Product Grid -->
    <div class="row d-flex align-items-stretch">
        @forelse($products as $product)
        <div class="col-12 col-sm-6 col-md-4 col-xl-3 d-flex align-items-stretch mb-4">
            
            <!-- Custom Product Card -->
            <div class="card custom-product-card w-100">
                
                <!-- Gray Image Wrapper -->
                <div class="product-image-container">
                    <!-- Brand Pill -->
                    <div class="brand-pill">
                        <i class="fas fa-check text-dark"></i>
                    </div>

                    <!-- Product Image -->
                    <img class="product-img" src="{{ $product->image_url ?? 'https://dummyimage.com/450x300/dee2e6/6c757d.jpg' }}" alt="{{ $product->name }}" />
                    
                    <!-- Fake Carousel Dots -->
                    <div class="carousel-indicators-custom">
                        <div class="carousel-dot active"></div>
                        <div class="carousel-dot"></div>
                        <div class="carousel-dot"></div>
                    </div>
                </div>
                
                <!-- Details Section -->
                <div class="product-details">
                    <!-- Badges & Wishlist -->
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge-bestseller">Best Seller</span>
                        <i class="fas fa-heart icon-heart"></i>
                    </div>
                    
                    <!-- Title -->
                    <h5 class="product-title">{{ $product->name }}</h5>
                    
                    <!-- Price and Action -->
                    <div class="d-flex justify-content-between align-items-end mt-3">
                        <div>
                            <div class="price-label">Price</div>
                            <div class="price-amount">${{ number_format($product->price, 2) }}</div>
                        </div>
                        <a href="{{ route('frontend.show', $product->id) }}" class="btn btn-buy-now">
                            Buy Now
                        </a>
                    </div>
                </div>

            </div>
            
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle mr-2"></i> No products available yet.
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection