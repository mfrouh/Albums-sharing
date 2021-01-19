@extends('layouts.app')
@section('title')
Users
@endsection
@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto">Users</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
		</div>
	</div>
  </div>
  <!-- breadcrumb -->
@endsection
@section('content')
				<!-- row opened -->
 <div class="row row-sm">
 	<div class="col-xl-12">
 		<div class="card mg-b-20">
 			<div class="card-header pb-0">
 				<div class="d-flex justify-content-between">
                     <h4 class="card-title mg-b-0">Users</h4>
 				</div>
 			</div>
 			<div class="card-body">
 				<div class="table-responsive">
 					<table class="table key-buttons text-md-nowrap text-center">
 						<thead>
 							<tr>
                                <th class="border-bottom-0">Name</th>
                                <th class="border-bottom-0">Email</th>
                                <th class="border-bottom-0">Count Public Albums </th>
                                <th class="border-bottom-0">Count Private Albums </th>
 								<th class="border-bottom-0">Action</th>
 							</tr>
 						</thead>
 						<tbody>
						 @foreach ($users as $user)
 							<tr>
                                 <td>{{$user->name}}</td>
                                 <td>{{$user->email}}</td>
                                 <td>{{$user->publicalbums()->count()}}</td>
                                 <td>{{$user->privatealbums()->count()}}</td>
 								<td>
                                     @can('delete users')
                                     <a class="btn btn-danger btn-sm"  href="/users/{{$user->id}}"
                                        onclick="event.preventDefault();
                                        document.getElementById('delete-user-{{$user->id}}').submit();"><i class="fa fa-trash" aria-hidden="true"></i>
                                     </a>
                                    <form id="delete-user-{{$user->id}}" action="/users/{{$user->id}}" method="POST" class="d-none">
                                        @csrf
                                        @method("delete")
                                    </form>
                                    @endcan
                                 </td>
 							</tr>
                         @endforeach
 						</tbody>
 					</table>
                 </div>
                    {{$users->links("pagination::bootstrap-4")}}
 			</div>
 		</div>
 	</div>
 </div>
@endsection
