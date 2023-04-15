@extends('layouts.app-uses-auth')

@section('app_section')
    <div class="products-wrapper pb-7">
        <div class="container">
            <div class="row">
                <div class="page-title col-md-12 text-center mb-5">
                    <h2 class="text-grey-900 fw-700 font-xxl pb-0 mb-1 d-block">Market Place</h2>

                    @if(Session::has('success'))
                        {{  showMsg($msg = Session::get('success'), $msgtype=1) }} 
                    @endif

                    @if($errors->any())
                        {{ showMsg($msg = $errors->all()[0], $msgtype=2) }}
                    @endif
                
                </div>
            </div> 

            <div class="row">
                @include('fragments.product-item')
            </div>
        </div>
    </div> 
@endsection