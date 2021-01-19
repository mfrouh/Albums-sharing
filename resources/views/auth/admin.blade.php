@extends('layouts.master2')
@section('title')
    Login
@endsection
@section('content')
<div class="container justify-content-center">
    <div class="row justify-content-center">
        <div class="col-md-5 col-sm-10">
            <a href="/">
               <img src="{{asset('images/logo-m.png')}}" data-src="{{asset('images/logo-m.png')}}"class="lazyload pb-1">
            </a>
            <h3 class="text-center pt-5">Login Admin</h3>
            <div class="card">
               <div class="card-body">
                <form action="{{route('admin.login')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="inputEmail">Your Email Addrss</label>
                        <input type="email" id="inputEmail" name="email" value="{{old('email')}}" class="form-control" placeholder="Write Your Email" required>
                        @error('email')
                            <span class="text-muted">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputPassword">Your Password </label>
                        <input type="password" id="inputPassword" name="password" class="form-control" placeholder=" Write Your password" required>
                        @error('password')
                            <span class="text-muted">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="text-center p-2">
                        <button type="submit" class="btn btn-warning">
                           login
                        </button>
                    </div>
                </form>
               </div>
            </div>
        </div>
    </div>
</div>
@endsection
