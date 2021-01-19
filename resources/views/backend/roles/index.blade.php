@extends('layouts.app')
@section('title')
Roles
@endsection
@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto">Roles</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
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
                     <h4 class="card-title mg-b-0">Roles</h4>
                     <a href="/roles/create" class="btn btn-primary-gradient btn-sm">Create Role</a>
 				</div>
 			</div>
 			<div class="card-body">
 				<div class="table-responsive">
 					<table class="table key-buttons text-md-nowrap text-center">
 						<thead>
 							<tr>
 								<th class="border-bottom-0">Name</th>
 								<th class="border-bottom-0">Action</th>
 							</tr>
 						</thead>
 						<tbody>
						 @foreach ($roles as $role)
 							<tr>
 								<td>{{$role->name}}</td>
 								<td>
                                     <a class="btn btn-success btn-sm" href="/roles/{{$role->id}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                     <a class="btn btn-primary btn-sm" href="/roles/{{$role->id}}/edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                     <a class="btn btn-danger btn-sm"  href="/roles/{{$role->id}}"
                                        onclick="event.preventDefault();
                                        document.getElementById('delete-role-{{$role->id}}').submit();"><i class="fa fa-trash" aria-hidden="true"></i>
                                     </a>
                                    <form id="delete-role-{{$role->id}}" action="/roles/{{$role->id}}" method="POST" class="d-none">
                                        @csrf
                                        @method("delete")
                                    </form>
                                 </td>
 							</tr>
						 @endforeach
 						</tbody>
 					</table>
                 </div>
                 {{$roles->links("pagination::bootstrap-4")}}
 			</div>
 		</div>
 	</div>
 </div>
@endsection
