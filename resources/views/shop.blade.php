@extends('layouts.app')

@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('{{ asset('assets/images/bg_6.jpg') }}');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="/">Home</a></span> <span>Products</span></p>
                    <h1 class="mb-0 bread">Collection Products</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-10 order-md-last">
                    <div class="row">
                        @foreach ($products as $product)
                            <div class="col-sm-6 col-md-6 col-lg-4 ftco-animate" category="{{$product->category_id}}">
                                <div class="product">
                                    <a href="#" class="img-prod"><img class="img-fluid"
                                            src="/storage/{{$product->cover}}" alt="Colorlib Template">
                                        @if ($product->discount != 0)
                                            <span class="status">{{$product->discount}}%</span>
                                        @endif
                                        <div class="overlay"></div>
                                    </a>
                                    <div class="text py-3 px-3">
                                        <h3><a href="#">{{$product->product_name}}</a></h3>
                                        <div class="d-flex">
                                            <div class="pricing">
                                                @if ($product->discount != 0)
                                                    <p class="price"><span class="mr-2 price-dc">${{$product->price}}</span>
                                                        <span class="price-sale">${{ number_format($product->price * ((100 - $product->discount) / 100), 2, '.', '.'); }}</span>
                                                    </p>
                                                @else
                                                    <p class="price"><span class="mr-2 price">${{$product->price}}</span></p>
                                                @endif
                                                
                                            </div>
                                        </div>
                                        <p class="bottom-area d-flex px-3">
                                            <a href="#" class="add-to-cart text-center py-2 mr-1"><span>Add to cart <i
                                                        class="ion-ios-add ml-1"></i></span></a>
                                        </p>
                                    </div>
                                </div>
                            </div>    
                        @endforeach
                    </div>
                    <div class="row mt-5">
                        <div class="col text-center">
                            <div class="block-27">
                                <ul>
                                    <li><a href="#">&lt;</a></li>
                                    <li class="active"><span>1</span></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                    <li><a href="#">&gt;</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-2 sidebar">
                    @foreach ($categories as $item)
                        <div class="sidebar-box-2">
                            <h2 class="heading mb-4"><a href="{{ route('shop.index', ['category_id' => $item->id]) }}">{{$item->category_name}}</a></h2>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
