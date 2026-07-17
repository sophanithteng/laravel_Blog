@extends('layout.Frontend')

@section('content')
<style>
    .product-showcase-img {
        border-radius: 16px;
        object-fit: cover;
        width: 100%;
        max-height: 500px;
        transition: transform 0.3s ease;
    }
    .product-showcase-img:hover {
        transform: scale(1.02);
    }
    .qty-input {
        width: 80px;
        border-radius: 50px;
    }
</style>

<div class="container px-4 px-lg-5 my-5">
    <div class="row gx-4 gx-lg-5 align-items-center bg-white p-4 p-md-5 rounded-4 shadow-sm">

        <div class="col-md-6 mb-4 mb-md-0">
            <img class="img-fluid product-showcase-img shadow" src="{{ asset('img/' . $product->image) }}" alt="{{ $product->name }}" />
        </div>

        <div class="col-md-6 ps-md-5">
            <div class="badge bg-light text-secondary border px-3 py-2 mb-3 rounded-pill">
                SKU: {{ $product->id }}
            </div>

            <h1 class="display-5 fw-bolder text-dark mb-2">{{ $product->name }}</h1>

            <div class="fs-2 mb-4 text-primary fw-bold">
                ${{ number_format($product->price, 2) }}
            </div>

            <p class="lead text-muted mb-5" style="line-height: 1.8;">
                {{ $product->description }}
            </p>

            <div class="d-flex align-items-center bg-light p-3 rounded-pill d-inline-flex border">
                <label for="inputQuantity" class="fw-bold px-3 text-secondary">Qty</label>
                <input class="form-control text-center me-3 qty-input border-0 shadow-sm" id="inputQuantity" type="number" value="1" min="1" />

                <button class="btn btn-warning rounded-pill px-4 py-2 shadow-sm flex-shrink-0 fw-bold text-dark" type="button">
                    <i class="bi bi-cart-fill me-2"></i> Add to cart
                </button>
            </div>

        </div>
    </div>
</div>
@endsection
