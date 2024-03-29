@extends('layouts.auth')

@section('content')

    <div class="new-login-box">
        <div class="white-box">
            <h3 class="box-title m-b-0">Sign In to Admin</h3>
            <small>Example` Email - admin@admin.com // Password - 123456789</small>

            <br/>
            @if($errors->any())
                <span class="invalid-feedback text-danger" role="alert"> <strong>{{ $errors->first() }} </strong> </span>
            @endif

            <form class="form-horizontal new-lg-form" id="loginform" method="POST" action="{{ route('admin_login') }}">
                @csrf

                <div class="form-group  m-t-20">
                    <div class="col-xs-12">
                        <label>Email Address</label>
                        <input class="form-control @error('email') is-invalid @enderror" type="email" required
                               placeholder="Email"
                               autocomplete="email" autofocus name="email" value="{{ old('email') }}">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <label>Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                               name="password" required placeholder="Password" autocomplete="current-password">
                    </div>
                </div>

                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button
                            class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light"
                            type="submit">Log In
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
