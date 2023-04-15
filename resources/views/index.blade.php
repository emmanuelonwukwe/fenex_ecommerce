@extends('layouts.app')

@section('app_section')
    <div class="products-wrapper mt-5 pt-3 pb-7">
        <div class="container">
            <div class="row">
                <div class="page-title col-md-12 text-center mb-5">
                    <h2 class="text-grey-900 fw-700 font-xxl pb-0 mb-1 d-block">Our Homepage</h2>
                    <p class="fw-300 font-xsss lh-28 text-grey-500">Hey! make your right product choice.</p>
                    @auth
                        @if(Session::has('success'))
                        {{  showMsg($msg = Session::get('success'), $msgtype=1) }} 
                        @endif

                        @if($errors->any())
                            {{ showMsg($msg = $errors->all()[0], $msgtype=2) }}
                        @endif
                    @endauth
                </div>
            </div> 

            <div class="row">
                @include('fragments.product-item')
            </div>

            @if($products->count() <= 0)
                <p style="color:maroon;font-weight:bold;text-align:center;"><span style="font-size:40px">sorry!!</span> No Product is created yet</p>

                @else

                @endif
        </div>
    </div> 
@endsection