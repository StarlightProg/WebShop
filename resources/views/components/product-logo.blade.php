<div class="product">
    <a href='/shop/{{$product->product_name}}' class="img-prod"><img class="img-fluid"
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
                @if (($product->discount) != 0)
                    <p class="price"><span class="mr-2 price-dc">${{$product->price}}</span>
                        <span class="price-sale">${{ number_format($product->price * ((100 - $product->discount) / 100), 2, '.', '.'); }}</span>
                    </p>
                @else
                    <p class="price"><span class="mr-2 price">${{$product->price}}</span></p>
                @endif
            </div>  
        </div>
        <form method="POST" action="{{ route('cart.store') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $product->id }}">
            <input type="hidden" name="quantity" value="1">
            <p class="bottom-area d-flex px-3">
                <a href="#" class="add-to-cart text-center py-2 mr-1"><span>Add to cart <i
                            class="ion-ios-add ml-1"></i></span></a>
            </p>
        </form>
        
    </div>
</div>