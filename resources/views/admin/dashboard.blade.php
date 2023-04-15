@extends('layouts.app-uses-auth')

@section('app_section')
    <section>
        <div class=container>
            <div class=row>
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="table-responsive">
                        <h2><span class="fa fa-list"></span> Users</h2>
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>S/n</th>
                                    <th>UserId</th>
                                    <th>Email</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Registered</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key => $user)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->phone}}</td>
                                        <td>{{$user->created_at}}</td>
                                    </tr>
                                @endforeach

                                @if($users->count() <= 0)
                                    <tr>
                                        <td><p style="color:maroon;font-weight:bold;text-align:center;">No user/admin is on table yet</p></td>                             
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