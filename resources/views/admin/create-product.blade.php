@extends("layouts.app-uses-auth")

@section("app_section")
    <section class="section ">
        <div class=container>
            <div class=row>
                <div class="col-sm-12 col-md-6 col-lg-6 offset-md-2 offset-lg-3">
                    <div class="card  w-100 p-2 mt-5 border-0">
                        <div class="card-body rounded-0 text-left pt-0 pb-2">
                            <h2 class="fw-600 display2-size mb-4"><span class="fa fa-edit"> {{ request()->get("update_product_id") != null ? "Update Product" : "Create Product"}}</h2>
                            
                            @if(Session::has('success'))
                                {{  showMsg($msg = Session::get('success'), $msgtype=1) }} 
                            @endif

                            @if($errors->any())
                                {{ showMsg($msg = $errors->all()[0], $msgtype=2) }}
                            @endif
                            
                            <form action="{{ route('admin.formcreate.product') }}"  method=POST enctype="multipart/form-data">
                                @csrf
                                <input hidden name=update_id value="{{ $_GET['update_product_id'] ?? null }}" >
                                <div class="form-group mb-3">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control h60 border-2 bg-color-none text-grey-700" name='name' value="{{ request()->get('update_product_id') !== null ? ($products->where('id', request()->get('update_product_id'))->first()->name ?? null) :  old('name') }}" placeholder="Enter Product Name">                        
                                </div>
                                <div class="form-group mb3">
                                    <label>Price</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><?= symbol("naira"); ?></span>
                                        </div>
                                        <input type="text" class="form-control h60 border-2 bg-color-none text-grey-700" name='price' value="{{ request()->get('update_product_id') !== null ? ($products->where('id', request()->get('update_product_id'))->first()->price ?? null) :  old('price') }}" placeholder="Enter Product Price">                        
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <p for="">Image</p>
                                    @if(request()->get('update_product_id') != null)
                                        <label>Note: Leave empty if you do not want to update the old image</label>
                                    @endif
                                    <input type="file" class="form-control h60 border-2 bg-color-none text-grey-700" name='image'  >                        
                                </div>

                                <div class="form-group mb-3">
                                    <label>Category</label>
                                    <select required type="text" class="form-control h60 border-2 bg-color-none text-grey-700" name='category_id'>
                                        @if(request()->get('update_product_id') != null)
                                            <option value="{{ ($products->where('id', request()->get('update_product_id'))->first()->category_id ?? null) ??  old('category_id')}}">{{ $categories->where('id', (($products->where('id', request()->get('update_product_id'))->first()->category_id ?? null) ??  old('category_id')))->first()->name ?? null  }}</option>
                                            @elseif(old('category_id') !== null)
                                            <option value='{{old("category_id")}}'>{{$categories->where('id', old("category_id"))->first()->name}}</option>
                                            @else
                                            <option value=''>Select Category</option>
                                        @endif

                                        @foreach($categories as $key => $category)
                                            <option value="{{  $category->id ?? null }}">{{  $category->name ?? null }}</option>
                                        @endforeach
                                    </select>                      
                                </div>
                                <div class="col-sm-12 p-0 text-center">
                                    <button type=submit class="btn btn-primary btn-block">Create Now</button>
                                </div>
                            </form>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </section>
@endsection("app_section")