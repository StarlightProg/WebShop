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
                                <x-product-logo :product="$product"></x-product-logo>
                            </div>    
                        @endforeach
                    </div>

                    <div>
                        {{$products->links()}}
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
