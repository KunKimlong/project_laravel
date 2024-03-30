@extends('FrontEnd.master')
@section('title')
    Search
@endsection
@section('content')
<main class="shop">

    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="main-title">
                        Product Result
                    </h3>
                </div>
            </div>
            <div class="row">
                @forelse ($product as $item)
                    <div class="col-3">
                        <figure>
                            <div class="thumbnail">
                                @if ($item->discount!=0)
                                    <div class="status">
                                        Promotion
                                    </div>
                                @endif
                                <a href="/product/{{$item->id}}">
                                    <img src="{{url('Image/'.$item->thumbnail)}}" alt="" width="261px" height="488px">
                                </a>
                            </div>
                            <div class="detail">
                                <div class="price-list">
                                    @if ($item->discount!=0)
                                        <div class="regular-price"><strike> US {{$item->regular_price}}</strike></div>
                                        <div class="sale-price ">US {{$item->sale_price}}</div>    
                                    @else
                                        <div class="price">US {{$item->regular_price}}</div>
                                    @endif
                                    
                                    
                                </div>
                                <h5 class="title">{{$item->name}}</h5>
                            </div>
                        </figure>
                    </div>
               @empty
                   <h1>No Product Found</h1>
               @endforelse
            </div>
        </div>

        <div class="container">
            <div class="row mt-5">
                <div class="col-12">
                    <h3 class="main-title">
                        News Result
                    </h3>
                </div>
            </div>
            <div class="row">
                @forelse ($news as $item)
                    <div class="col-3">
                        <figure>
                            <div class="thumbnail">
                                <a href="">
                                    <img src="https://placehold.co/300x300" alt="">
                                </a>
                            </div>
                            <div class="detail">
                                <h5 class="title">But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born</h5>
                            </div>
                        </figure>
                    </div>
                @empty
                    <h1>No news found</h1>
                @endforelse
                
            </div>
        </div>
    </section>

</main>
@endsection