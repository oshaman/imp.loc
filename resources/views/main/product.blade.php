@foreach ($products as $product)
    <div class="grid-product">
        <div class="  product-grid">
            <div class="content_box"><a href="single.html">
                    <div class="left-grid-view grid-view-left">
                        <img src="{{ $product->picture }}" class="img-responsive watch-right new" alt=""/>
                        <div class="mask">
                            <div class="info">Quick View</div>
                        </div>
                    </div>
                </a>
            </div>
            <h4><a href="{{ $product->url }}">{{ str_replace("\xc2\xa0",' ',$product->description) }}</a></h4>
            <p>{!! $product->stock !!}</p>
            <div class="dolor-grid">
                <span class="actual">&#x20b4; {{ $product->viewPrice }}</span>
                <span class="reducedfrom">{{ $product->viewPrice }}</span>
                @include('main.raiting')
            </div>
        </div>
    </div>
@endforeach