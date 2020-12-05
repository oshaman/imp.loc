@foreach($categories as $category)
    <li class="item1">
        <a href="{{ route('products', ['category' => $category->category_id]) }}">
            {{ $category->description }}
            @if(count($category->children) > 0)
                <img class="arrow-img"
                     src="{{ asset('assets') }}/images/arrow1.png" alt=""/>
            @endif
        </a>
        <ul class="cute">
            @if(count($category->children) > 0)
                @include('main.category', ['categories' => $category->children])
            @endif
        </ul>
    </li>
@endforeach