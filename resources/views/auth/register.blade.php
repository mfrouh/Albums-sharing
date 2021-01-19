@extends('layouts.frontend')
@section('content')
<div class="container">
    <h3 class="text-center">Sign Up To Join Us</h3>

    <div class="row justify-content-center">
        <div class="col-md-7 col-sm-10">
            <div class="contact-form">
                <form action="{{route('register')}}" method="POST">
                    @csrf
                    <div class="form-group ">
                        <label for="inputName">Write Your Name</label>
                        <input type="text" id="inputName" name="name" class="form-control"placeholder="Write Your Name" required>
                        @error('name')
                           <span class="text-muted">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">Your Email Addrss</label>
                        <input type="email" id="inputEmail" name="email" class="form-control"placeholder="Write Your Email" required>
                        @error('email')
                           <span class="text-muted">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputPassword">Enter Password </label>
                        <input type="password" id="inputPassword" name="password" class="form-control" placeholder=" Write Your password" required>
                        @error('password')
                           <span class="text-muted">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="inputConfirmPassword">Confirm Password </label>
                        <input type="password" id="inputConfirmPassword" name="password_confirmation" class="form-control" placeholder="  Confirm Your password" required>
                    </div>

                    <div class="text-center p-2">
                        <button type="submit" class="btn btn-gradiant">
                           Sign Up
                        </button>
                    </div>
                    <div >
                       <b> <span>Have An Account ?</span> <a href="/login" class="main-color ">Login</a></b>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
