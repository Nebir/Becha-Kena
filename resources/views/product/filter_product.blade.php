@foreach($products->chunk(4) as $productChunk)
    <div class="row">
        @foreach($productChunk as $product)
            <div class="col-md-3 four-thumbs">
                @include('product._product_thumbnail')
            </div>
        @endforeach
    </div>
@endforeach

<div class="row">
    <div class="col-md-12 text-center" id="ajax-pagination">
        {!! $products->appends([
            'category' => request('category', 'all'),
            'search' => request('search', null),
            'price' => request('price', 'all'),
            'choice' => request('choice', 'popular')
        ])->links() !!}
    </div>
</div>