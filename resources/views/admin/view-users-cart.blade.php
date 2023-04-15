@extends('layouts.app-uses-auth')

@section('app_section')
    <section>
        <div class=container>
            <div class=row>
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="table-responsive">
                        <h2><span class="fa fa-list"></span> Users Cart</h2>
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>S/n</th>
                                    <th>Owner Name</th>
                                    <th>CartId</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Added@</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($carts as $key => $cart)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$cart->user->name}}</td>
                                        <td>{{$cart->id}}</td>
                                        <td>{{$cart->product->name}}</td>
                                        <td>{{$cart->quantity}}</td>
                                        <td>{{$cart->created_at}}</td>
                                    </tr>
                                @endforeach

                                @if($carts->count() <= 0)
                                    <tr>
                                        <td><p style="color:maroon;font-weight:bold;text-align:center;">Cart is empty at the moment as no user had added anything to it</p></td>                             
                                    </tr>
                                @else

                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection