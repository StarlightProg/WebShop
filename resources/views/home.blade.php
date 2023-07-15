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
                    </div>
                @endfor

            </div>
        </div>
    </section>
@endsection
