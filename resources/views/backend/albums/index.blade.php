@extends('layouts.app')
@section('title')
Albums
@endsection
@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto">Albums</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
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
                     <h4 class="card-title mg-b-0">Albums</h4>
 				</div>
 			</div>
 			<div class="card-body">
 				<div class="table-responsive">
 					<table class="table key-buttons text-md-nowrap text-center">
 						<thead>
 							<tr>
                                <th class="border-bottom-0">Name</th>
                                <th class="border-bottom-0">User Name</th>
                                <th class="border-bottom-0">Type</th>
                                <th class="border-bottom-0">Count Photos In Album </th>
 								<th class="border-bottom-0">Action</th>
 							</tr>
 						</thead>
 						<tbody>
						 @foreach ($albums as $album)
 							<tr>
                                 <td>{{$album->name}}</td>
                                 <td>{{$album->user->name}}</td>
                                 <td>{{$album->type}}</td>
                                 <td>{{$album->gallery->count()}}</td>
 								<td>
                                     <a class="btn btn-danger btn-sm"  href="/albums/{{$album->id}}"
                                        onclick="event.preventDefault();
                                        document.getElementById('delete-album-{{$album->id}}').submit();"><i class="fa fa-trash" aria-hidden="true"></i>
                                     </a>
                                    <form id="delete-album-{{$album->id}}" action="/albums/{{$album->id}}" method="POST" class="d-none">
                                        @csrf
                                        @method("delete")
                                    </form>
                                 </td>
 							</tr>
                         @endforeach
 						</tbody>
 					</table>
                 </div>
                 {{$albums->links("pagination::bootstrap-4")}}
             </div>
 		</div>
 	</div>
 </div>
@endsection
