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
 					<table class="table key-buttons text-md-nowrap text-center albums">
 						<thead>
 							<tr>
                                <th class="border-bottom-0">Name</th>
                                <th class="border-bottom-0">User Name</th>
                                <th class="border-bottom-0">Type</th>
								<th class="border-bottom-0">Show Album</th>
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
								 <td><a class="btn btn-success btn-sm album" href="javascript:void(0);" data-id='{{$album->id}}'><i class="fa fa-eye" aria-hidden="true"></i></a></td>
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
 <div class="modal fade bd-example-modal-lg" id="galleryalbums" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Album</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-0">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                </ol>
                <div class="carousel-inner">
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
        </div>
      </div>
    </div>
</div>
@endsection
@section('js')
<script>

$('.albums').on('click','.album',function(e){
    var id=$(this).attr('data-id');
    $.ajax({
        type: "get",
        url: "/getgallery/"+id,
        dataType: "json",
        success: function (response) {
            $('#galleryalbums').modal('toggle');
            var images='';
            var cr='';
            $.each(response, function(index, value) {
                var active='';
                if(index==0)
                {
                  active='active';
                }else{
                  active='';
                }
                images+=
             '<div class="carousel-item '+active+' ">'+
                '<img class="d-block w-100" height="400px" src="'+value.url+'">'+
             '</div>'
             });
             $.each(response, function(index, value) {
                var active='';
                if(index==0)
                {
                  active='active';
                }else{
                  active='';
                }
                cr+='<li data-target="#carouselExampleIndicators" data-slide-to="'+index+'" class="'+active+'"></li>'
             });
             $('.carousel-indicators').html(cr);
             $('.carousel-inner').html(images);
        }
    });
});
</script>
@endsection
