@extends('layouts.app')
@section('title')
Update Admin
@endsection
@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto">Update Admin</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
		</div>
	</div>
  </div>
  <!-- breadcrumb -->
@endsection
@section('content')
                <!-- row opened -->
<form action="/admins/{{$admin->id}}" method="post">
 @csrf
 @method('put')
 <div class="row row-sm">
 	<div class="col-xl-8">
 		<div class="card mg-b-20">
 			<div class="card-header pb-0">
 				<div class="d-flex justify-content-between">
 					<h4 class="card-title mg-b-0">Update Admin</h4>
 				</div>
 			</div>
 			<div class="card-body">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" value="{{$admin->name}}"  placeholder="Name" required>
                    @error('name')
                    <small id="helpId" class="text-muted">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror" value="{{$admin->email}}" placeholder="Email" required>
                    @error('email')
                    <small id="helpId" class="text-muted">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    @error('password')
                       <span class="text-muted">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label >Confirm Password </label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                </div>
                <div class="form-group text-center">
                    <input type="submit" class="btn btn-primary" value="Save">
                </div>
 			</div>
 		</div>
     </div>
 </div>
</form>
@endsection
