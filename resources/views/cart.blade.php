@extends('layouts.app')

@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('{{ asset('assets/images/bg_6.jpg') }}');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="/">Home</a></span> <span>Cart</span></p>
                    <h1 class="mb-0 bread">My Cart</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section ftco-cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                        <table class="table">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $totalPrice = 0;
                                ?>

                                @foreach ($goods as $item)
                                    <?php 
                                        $totalPrice += $item['product']['price'] * $item['quantity'];
                                    ?>
                                    <tr class="text-center">
                                        
                                        
                                        <form method="POST" action="/cart/{{$item['product']['id']}}">
                                            @method('DELETE')
                                            @csrf
                                            <td class="product-remove">
                                                <button style="border: 1px solid rgba(0, 0, 0, 0.1);
                                                padding: 0px 20px;
                                                color: #000000; cursor: pointer;" type="submit"><span class="ion-ios-close"></span></button>
                                            </td>
                                        </form>

                                        {{-- <td class="product-remove"><a href="#"><span class="ion-ios-close"></span></a>
                                        </td> --}}

                                        <td class="image-prod">
                                            <div class="img" style="background-image:url({{ "/storage/" . $item['product']['cover']}});"></div>
                                        </td>

                                        <td class="product-name">
                                            <h3>{{$item['product']['product_name']}}</h3>
                                        </td>

                                        <td class="price">${{$item['product']['price']}}</td>

                                        <td class="quantity">
                                            <div class="input-group mb-3">
                                                <input type="text" name="quantity" class="quantity form-control input-number"
                                                    value="{{$item['quantity']}}" min="1" max="100">
                                            </div>
                                        </td>

                                        <td class="total">${{$item['product']['price'] * $item['quantity']}}</td>
                                    </tr>  
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
                    <div class="cart-total mb-3">
                        <h3>Cart Totals</h3>
                        <p class="d-flex total-price">
                            <span>Total</span>
                            <span>${{$totalPrice}}</span>
                        </p>
                    </div>
                    <p class="text-center"><a href="/checkout" class="btn btn-primary py-3 px-4">Proceed to Checkout</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            var quantitiy = 0;
            $('.quantity-right-plus').click(function(e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());
                // If is not undefined
                $('#quantity').val(quantity + 1);
                // Increment
            });

            $('.quantity-left-minus').click(function(e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());
                // If is not undefined
                // Increment
                if (quantity > 0) {
                    $('#quantity').val(quantity - 1);
                }
            });

        });
    </script>
@endsection
