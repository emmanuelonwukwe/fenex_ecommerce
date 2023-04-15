@extends("layouts.app")

@section("app_section")
    <section class="section offset-bar">
        <div class=container>
            <div class=row>
                <div class="col-sm-12 col-md-6 col-lg-6 offset-md-2 offset-lg-3">
                    <div class="card  w-100 p-2 mt-5 border-0">
                        <div class="card-body rounded-0 text-left pt-0 pb-2">
                            <h2 class="fw-600 display2-size mb-4"><span class="fa fa-edit"> Admin Register</h2>                            
                            @if($errors->any())
                                {{ showMsg($msg = $errors->all()[0], $msgtype=2) }}
                            @endif
                            
                            <form action="{{ route('register') }}" method=POST>
                                @csrf
                                
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control h60 border-2 bg-color-none text-grey-700" name=name value="{{ old('name') }}" placeholder="Enter Your Name">                        
                                </div>
                                <div class="form-group mb-3">
                                    <input type="email" class="form-control h60 border-2 bg-color-none text-grey-700" name=email value="{{ old('email') }}" placeholder="Enter Your Email">                        
                                </div>
                                <div class="form-group mb-3">
                                    <input type="tel" class="form-control h60 border-2 bg-color-none text-grey-700" name=phone value="{{ old('phone') }}" placeholder="Enter Your Phone Number">                        
                                </div>
                                <div class="form-group mb-3">
                                    <select hidden class="form-control h60 border-2 bg-color-none text-grey-700" name=role >
                                        <option value=admin>Admin</option>
                                    </select>
                                </div>
                                <div class="form-group icon-tab mb-3">
                                    <input type="password" class="form-control h60 border-2 bg-color-none text-grey-700" style="-webkit-text-security: square;text-security: square" name=password placeholder="Password">
                                    <i class="ti-lock text-grey-700 pr-0"></i>
                                </div>
                                <div class="form-group icon-tab mb-3">
                                    <input type="password" class="form-control h60 border-2 bg-color-none text-grey-700" name=password_confirmation placeholder="Confirm Password">
                                    <i class="ti-lock text-grey-700 pr-0"></i>
                                </div>
                                <div class="col-sm-12 p-0 text-center">
                                    <button type=submit class="btn btn-primary btn-block">Create an account</button>
                                    <h6 class="text-grey-500 font-xsss fw-500 mt-2 mb-4 lh-32">Are you already member? <a href="{{ route('login') }}" class="fw-700 ml-1" >Login</a></h6>
                                </div>
                            </form>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </section>
@endsection("app_section")