@extends('layouts.frontend')
@section('content')
<div class="container">
    <h3 class="text-center">Login To Join Us</h3>

    <div class="row justify-content-center">
        <div class="col-md-7 col-sm-10">
            <div class="contact-form">
                <form action="{{route('login')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="inputEmail">Your Email Addrss</label>
                        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Write Your Email" required>
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
                        <button type="submit" class="btn btn-gradiant">
                           login
                        </button>
                    </div>

                    <div >
                       <b> <span>Don't Have An Account ?</span> <a href="/register" class="main-color ">Sign Up</a></b>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
