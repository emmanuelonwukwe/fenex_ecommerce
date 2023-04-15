@extends("layouts.app-uses-auth")

@section("app_section")
    <section class="section">
        <div class=container>
            <div class=row>
                <div class="col-sm-12 col-md-6 col-lg-6 offset-md-2 offset-lg-3">
                    <div class="card  w-100 p-2 mt-5 border-0">
                        <div class="card-body rounded-0 text-left pt-0 pb-2">
                            <h2 class="fw-600 display2-size mb-4"><span class="fa fa-edit"> {{ request()->get("update_category_id") != null ? "Update Category" : "Create Category"}}</h2>
                            
                            @if(Session::has('success'))
                                {{  showMsg($msg = Session::get('success'), $msgtype=1) }} 
                            @endif

                            @if($errors->any())
                                {{ showMsg($msg = $errors->all()[0], $msgtype=2) }}
                            @endif
                            
                            <form action="{{ route('admin.formcreate.category') }}"  method=POST>
                                @csrf 

                                <input hidden name=update_id value="{{ $_GET['update_category_id'] ?? null }}" >
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control h60 border-2 bg-color-none text-grey-700" name='name' value="{{ request()->get('update_category_id') !== null ? ($categories->where('id', request()->get('update_category_id'))->first()->name ?? null) :  old('name') }}" placeholder="Enter Category Name">                        
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