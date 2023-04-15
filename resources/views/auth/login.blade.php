@extends("layouts.app")

@section("app_section")
    <section class="section offset-bar">
        <div class=container>
            <div class=row>
                <div class="col-sm-12 col-md-6 col-lg-6 offset-md-2 offset-lg-3">
                    <div class="card  w-100 p-2 mt-5 border-0">
                        <div class="card-body rounded-0 text-left pt-0 pb-2">
                            <h2 class="fw-600 display2-size mb-4"><span class="fa fa-user"> Login</h2>
                            
                            @if($errors->any())
                                {{ showMsg($msg = $errors->all()[0], $msgtype=2) }}
                            @endif
                            
                            <form action="{{ route('login') }}" method=POST>
                                @csrf

                                <div class="form-group mb-3">
                                    <input type="text" class="form-control h60 border-2 bg-color-none text-grey-700" name=email placeholder="Account Email number" value="{{ old('email') }}">                        
                                </div>
                                <div class="form-group icon-tab mb-1">
                                    <input type="text" class="form-control h60 border-2 bg-color-none text-grey-700" name=password placeholder="Enter Password">
                                    <i class="ti-lock text-grey-700 pr-0"></i>
                                </div>
                                <div class="form-check text-left mb-3">
                                    <input type="checkbox" class="form-check-input mt-2">
                                    <label class="form-check-label font-xsss text-grey-500" for="exampleCheck1">Remember me</label>
                                    <a href="{{ url('password/reset') }}" class="fw-600 font-xsss text-grey-700 mt-1 float-right">Forgot your Password?</a>
                                </div>

                                <div class="col-sm-12 p-0 text-center">
                                    <button type=submit class="btn btn-primary btn-block">Login</button>
                                    <h6 class="text-grey-500 font-xsss fw-500 mt-2 mb-0 lh-32">Dont have account <a href="{{ route('register') }}" class="fw-700 ml-1">Register</a></h6>
                                </div>
                            </form>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </section>
@endsection("app_section")

