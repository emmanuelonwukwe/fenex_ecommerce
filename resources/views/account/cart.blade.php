@extends('layouts.app-uses-auth')

@section('app_section')
    <div class="products-wrapper  pb-7">
        <div class="container">
            <div class="row">
                <div class="page-title col-md-12 text-center mb-5">
                    <h2 class="text-grey-900 fw-700 font-xxl pb-0 mb-1 d-block">Cart Summary</h2>

                    @if(Session::has('success'))
                        {{  showMsg($msg = Session::get('success'), $msgtype=1) }} 
                    @endif

                    @if($errors->any())
                        {{ showMsg($msg = $errors->all()[0], $msgtype=2) }}
                    @endif
                </div>
                <div class="col-md-12 mb-5">
                    <p class="text-grey-900"><span class="fa fa-house"></span> Total Amount: <b><?= symbol("naira") ?> {{ $cartTotalAmount }} </b> <span class="float-right"><button class="btn btn-secondary">checkout <span class="fa fa-caret-right"></span></button></span></p>
                </div>
            </div> 

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 mb-12">
                    <p class="bg-secondary pl-3 text-white">Total Products Quantity: ({{ $carts->where("user_id", auth()->user()->id)->sum('quantity') }})</p>
                </div>
                
                @foreach($carts->where('user_id', auth()->user()->id) as $index => $cartItem)
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                        <div class="products-area">
                            <div class="product p-0">
                                <div class=row>
                                    <div class="col-xs=6 col-sm-6 col-md-6 col-lg-6">
                                        <a href="{{ url('storage'). '/'.$cartItem->product->image }}"><img src="{{ url('storage'). '/'.$cartItem->product->image }}" alt="product-image" class="rounded-lg w-100"></a>
                                    </div>
                                    <div class="col-xs=6 col-sm-6 col-md-6 col-lg-6">
                                        <h6 class="font-xssss text-grey-500 fw-600 ml-0 mt-3 float-left"><img src="{{asset('images/star.png')}}" alt="product-prename-image"> {{ $cartItem->product->name }} </h6> 
                                        <div class="clearfix"></div>
                                        <p class="product-description mt-0 mb-0 pl-0 pr-3">
                                            <span class="lh-28 font-xs mont-font text-grey-800 fw-700">This is an Awesome product with the following details below <i class="fa fa-circle"></i> <b ><?= symbol("naira") ?> {{ $cartItem->product->price . " X ". $cartItem->quantity }} <br> Quantity: {{ $cartItem->quantity }} units</b> <br/>
                                            <em>productId: {{ $cartItem->product->id }} and categoryId: {{ $cartItem->product->category->id }}</em></span>
                                        </p>
                                    </div>
                                    <div class="col-xs=6 col-sm-6 col-md-6 col-lg-6">
                                        <form action="{{ route('cart.delete') }}" method="POST">
                                            @csrf
                                            @method("DELETE")

                                            <input hidden value="{{ $cartItem->id }}" name="cart_id" />
                                            <button type=submit class="btn btn-text btn-danger cart-add-btn"><span class="fa fa-trash"></span> Remove</button>                               
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                @if($carts->where('user_id', auth()->user()->id)->count() <= 0)
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-12">
                        <p style="color:maroon;font-weight:bold;text-align:center;">Cart is empty at the moment</p>
                    </div>
                @else

                @endif

            </div>
        </div>
    </div> 
@endsection