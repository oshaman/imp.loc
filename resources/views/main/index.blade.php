@extends('layouts.app')

@section('head')
    @include('main.head', ['some' => 'data'])
@endsection

@section('header')
    @include('main.header', ['some' => 'data'])
@endsection

@section('content')
    <div class="women-product">
        <div class=" w_content">
            <div class="women">
                <a href="#"><h4>Найдено - <span>{{ $products->total() }} товаров</span></h4></a>
                <ul class="w_nav">
                    <li>Sort :</li>
                    <li><a class="active" href="#">popular</a></li>
                    |
                    <li><a href="#">new </a></li>
                    |
                    <li><a href="#">discount</a></li>
                    |
                    <li>
                        <a href="{{ url()->current().'?'.http_build_query(array_merge(request()->all(),['sort_by' => "price"])) }}">
                            "По цене"
                        </a>
                    </li>
                    <div class="clearfix"></div>
                </ul>
                <div class="clearfix"></div>
            </div>
        </div>
    @include('main.pagination', ['some' => 'data'])
    <!-- grids_of_4 -->
        <div class="grid-product">
            @include('main.product', ['some' => 'data'])
            <div class="clearfix"></div>
        </div>
        @include('main.pagination', ['some' => 'data'])
    </div>
@endsection
@section('categories')
    <ul class="menu">
        @include('main.category', ['categories' => $categories])
    </ul>
@endsection

@section('footer')
    @include('main.footer')
@endsection