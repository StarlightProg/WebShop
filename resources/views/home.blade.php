@extends('layouts.app')

@section('content')

    <section class="ftco-section bg-light" style="padding: 30px;">
        <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <h2 class="mb-4">Best Sellers</h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @for ($i = 0; $i < ((count($products) < 4) ? count($products) : 4); $i++)
                    <div class="col-sm col-md-6 col-lg ftco-animate">
                        <x-product-logo :product="$products[$i]"></x-product-logo>
                        {{-- <div class="product">
                            <a href='/shop/{{$products[$i]->product_name}}' class="img-prod"><img class="img-fluid"
                                    src="/storage/{{$products[$i]->cover}}" alt="Colorlib Template">
                                @if ($products[$i]->discount != 0)
                                    <span class="status">{{$products[$i]->discount}}%</span>
                                @endif
                                <div class="overlay"></div>
                            </a>
                            <div class="text py-3 px-3">
                                <h3><a href="#">{{$products[$i]->product_name}}</a></h3>
                                <div class="d-flex">
                                    <div class="pricing">
                                        @if (($products[$i]->discount) != 0)
                                            <p class="price"><span class="mr-2 price-dc">${{$products[$i]->price}}</span>
                                                <span class="price-sale">${{ number_format($products[$i]->price * ((100 - $products[$i]->discount) / 100), 2, '.', '.'); }}</span>
                                            </p>
                                        @else
                                            <p class="price"><span class="mr-2 price">${{$products[$i]->price}}</span></p>
                                        @endif
                                        
                                    </div>
                                    
                                    
                                </div>
                                <form method="POST" action="{{ route('cart.store') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $products[$i]->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <p class="bottom-area d-flex px-3">
                                        <a href="#" class="add-to-cart text-center py-2 mr-1"><span>Add to cart <i
                                                    class="ion-ios-add ml-1"></i></span></a>
                                    </p>
                                </form>
                                
                            </div>
                        </div> --}}
                        {{-- <div class="rating">
                                        <p class="text-right">
                                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        </p>
                                    </div> --}}
                    </div>
                @endfor

            </div>
        </div>
    </section>
@endsection
