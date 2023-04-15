@extends('layouts.app-uses-auth')

@section('app_section')
    <section>
        <div class=container>
            <div class=row>
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="table-responsive">
                        <h2><span class="fa fa-list"></span> Products</h2>
                        @if(Session::has('success'))
                            {{  showMsg($msg = Session::get('success'), $msgtype=1) }} 
                        @endif

                        @if($errors->any())
                            {{ showMsg($msg = $errors->all()[0], $msgtype=2) }}
                        @endif
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>S/n</th>
                                    <th>ProductId</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>categoryId</th>
                                    <th>Created@</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $key => $product)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$product->id}}</td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->image}}</td>
                                        <td>{{$product->category_id}}</td>
                                        <td>{{$product->created_at}}</td>
                                        <td>
                                            <a href="{{ route('admin.create.product', ['update_product_id' => $product->id]) }}" class=btn><span class="fa fa-edit"></span> Update</a>
                                        </td>

                                        <td>
                                            <form action="{{ route('admin.delete.product') }}" method=POST>
                                                @csrf
                                                @method("DELETE")
                                                <input hidden name=product_id value="{{ $product->id }}" >
                                                <button type=submit><span class="fa fa-trash"></span> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                                @if($products->count() <= 0)
                                    <tr>
                                        <td><p style="color:maroon;font-weight:bold;text-align:center;">You have not created any product yet</p></td>                             
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