@extends('layouts.app')

@section('content')

    <section class="ftco-section bg-light">
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
                        <div class="product">
                            <a href="#" class="img-prod"><img class="img-fluid"
                                    src="{{ asset('assets/images/' . $products[$i]->cover) }}" alt="Colorlib Template">
                                @if (!is_null($products[$i]->discount))
                                    <span class="status">{{$products[$i]->discount}}%</span>
                                @endif
                                <div class="overlay"></div>
                            </a>
                            <div class="text py-3 px-3">
                                <h3><a href="#">{{$products[$i]->product_name}}</a></h3>
                                <div class="d-flex">
                                    <div class="pricing">
                                        <p class="price"><span class="mr-2 price-dc">${{$products[$i]->price}}</span>
                                            @if (!is_null($products[$i]->discount_price))
                                                <span class="price-sale">${{$products[$i]->discount_price}}</span>
                                            @endif
                                        </p>
                                    </div>
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
                        </div>
                    </div>
                @endfor

            </div>
        </div>
    </section>
@endsection
