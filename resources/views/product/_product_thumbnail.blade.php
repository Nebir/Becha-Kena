<div class="product-card">
    <a href="{{ route('product.show', $product) }}">
        <img class="img-responsive center-block" alt="{{ $product->name }}" src="{{ asset($product->image) }}">
    </a>
    <div class="row">
        <div class="col-md-7">
            <a href="{{ route('product.show', $product) }}">
                <h4>{{ $product->name }}</h4>
            </a>
        </div>
        <div class="col-md-5">
            <span>৳ {{ $product->unit_price }}</span>
        </div>
    </div>
    <p>{{ str_limit($product->description, 125) }}</p>
</div>