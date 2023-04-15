
@foreach($categories as $cateIndex => $category)

    @if($products->where('category_id', $category->id)->count() > 0)
        <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
            <p class="bg-secondary pl-3 text-white"><span class="fa fa-list"></span> Category: {{ $category->name }} </p>
        </div>
    
        @foreach($products as $prodIndex => $product)
            @if($product->category_id  == $category->id )
                <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                    <div class="products-area">
                        <div class="product">
                            <a href="{{ url('storage'). '/'.$product->image }}"><img onerror="" src="{{ url('storage'). '/'.$product->image }}" alt="product-image" class="rounded-lg w-100"></a>
                            <h6 class="font-xssss text-grey-500 fw-600 ml-0 mt-3 float-left"><img src="{{asset('images/star.png')}}" alt="product-prename-image"> {{ $product->name  }} </h6> 
                            <div class="clearfix"></div>
                            <p class="product-description mt-0 mb-0 pl-0 pr-3">
                                <span class="lh-28 font-xs mont-font text-grey-800 fw-700">This is an Awesome product with the following details below <i class="fa fa-circle"></i> <b ><?= symbol("naira") ?>{{ $product->price  }} </b> <br/> <em>productId: {{ $product->id  }} and categoryId: {{ $category->id  }}</em></span>
                            </p>
                            @auth
                                <form action="{{ route('cart.add.product', ['product_id' => $product->id]) }}" method="POST">
                                    @csrf
                                    <input hidden value="{{ $product->id }}" name="product_id" />
                                    <input hidden value="plus" name="intention" />
                                    <button type=submit class="btn btn-sm btn-warning cart-add-btn"><span class="fa fa-shopping-cart"><span class="badge badge-light" >{{ auth()->user() ? $carts->where('product_id', $product->id )->where('user_id', auth()->user()->id)->sum('quantity') : 0 }}</span> <br>Add to cart</span></button>                               
                                </form>
                            @endauth

                            @guest
                                <a href="{{ route('login') }}" class="btn btn-sm btn-warning cart-add-btn"><span class="fa fa-shopping-cart"><br>Add to cart</span></a>                               
                            @endguest
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

    @endif

@endforeach