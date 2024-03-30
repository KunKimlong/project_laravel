@extends('FrontEnd.master')
@section('title')
    Home
@endsection
@section('content')

<main class="home">
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="main-title">
                        NEW PRODUCTS
                    </h3>
                </div>
            </div>
            <div class="row">
               @forelse ($NewProduct as $item)
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
                   <h1>No Product right now</h1>
               @endforelse
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="main-title">
                        PROMOTION PRODUCTS
                    </h3>
                </div>
            </div>
            <div class="row">
                @forelse ($Promotion as $item)
                    <div class="col-3">
                        <figure>
                            <div class="thumbnail">
                                <div class="status">
                                    Promotion
                                </div>
                                <a href="/product/{{$item->id}}">
                                    <img src="{{url('Image/'.$item->thumbnail)}}" alt="" width="261px" height="488px">
                                </a>
                            </div>
                            <div class="detail">
                                <div class="price-list">
                                    <div class="regular-price"><strike> US {{$item->regular_price}}</strike></div>
                                    <div class="sale-price ">US {{$item->sale_price}}</div>    
                                </div>
                                <h5 class="title">{{$item->name}}</h5>
                            </div>
                        </figure>
                    </div>
                @empty
                    <h1>No Product right now</h1>
                @endforelse
            </div>
        </div>
    </section>  

    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="main-title">
                        POPULAR PRODUCTS
                    </h3>
                </div>
            </div>
            <div class="row">
                @forelse ($Popular as $item)
                    <div class="col-3">
                        <figure>
                            <div class="thumbnail">
                                <div class="status">
                                    Promotion
                                </div>
                                <a href="/product/{{$item->id}}">
                                    <img src="{{url('Image/'.$item->thumbnail)}}" alt="" width="261px" height="488px">
                                </a>
                            </div>
                            <div class="detail">
                                <div class="price-list">
                                    <div class="regular-price"><strike> US {{$item->regular_price}}</strike></div>
                                    <div class="sale-price ">US {{$item->sale_price}}</div>    
                                </div>
                                <h5 class="title">{{$item->name}}</h5>
                            </div>
                        </figure>
                    </div>
                @empty
                    <h1>No Product right now</h1>
                @endforelse
            </div>
        </div>
    </section>

</main> 
@endsection