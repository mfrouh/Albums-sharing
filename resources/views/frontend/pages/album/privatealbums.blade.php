@extends('layouts.frontenduser')
@section('content')
<div class="row albums">
    @forelse ($albums as $album)
    <div class="col-md-4">
        <div class="card wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">
            <div class="card-header">
             @if ($album->image)
                <img src="{{asset($album->image)}}" class="lazyload album" data-id="{{$album->id}}">
                <a href="javascript:void(0);" class="btn btn-danger btn-sm delete" data-id="{{$album->id}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                <a href="/album/{{$album->id}}/edit" class="btn btn-primary btn-sm "><i class="fa fa-edit" aria-hidden="true"></i></a>
             @else
                <img src="{{asset('images/demo1.png')}}" class="lazyload album" data-id="{{$album->id}}">
                <a href="javascript:void(0);" class="btn btn-danger btn-sm delete" data-id="{{$album->id}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                <a href="/album/{{$album->id}}/edit" class="btn btn-primary btn-sm "><i class="fa fa-edit" aria-hidden="true"></i></a>
             @endif
            </div>
            <div class="card-body">
                <h6> <a href="javascript:void(0);">{{$album->name}}</a></h6>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 bg-danger p-3">Not Found  Albums</div>
    @endforelse
</div>
@if($albums->count()>=9)
<a href="javascript:void(0);" class="btn btn-warning more" data-id="{{$album->id}}">load more</a>
@endif
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
$('.more').click(function(e){
    e.preventDefault();
    $('.more').text('loading...');
    $('.more').addClass('disabled');
    var id =$('.more').attr('data-id');
    $.ajax({
        type: "get",
        url: "{{route('privatealbum.more')}}",
        data:{id:id},
        dataType: "json",
        success: function (response) {
          var albums='';
          albums+='';
          if (response.length>0) {
              response.forEach(element => {
                  albums+=
                  '<div class="col-md-4">'+
                    '<div class="card wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">'+
                    '<div class="card-header">'+
                     '<img src="/'+element.image+'" class="lazyload album" data-id="'+element.id+'">'+
                     '<a href="javascript:void(0);" class="btn btn-danger btn-sm delete" data-id="'+element.id+'"><i class="fa fa-trash" aria-hidden="true"></i></a>'+
                     '<a href="/album/'+element.id+'/edit" class="btn btn-primary btn-sm" data-id="'+element.id+'"><i class="fa fa-edit" aria-hidden="true"></i></a>'+
                    '</div>'+
                   ' <div class="card-body">'+
                      '<h6> <a href="javascript:void(0);">'+element.name+'</a></h6>'+
                    '</div>'+
                  '</div>'+
                  '</div>';
                  $('.more').attr('data-id',element.id)
              });
             $('.albums').append(albums);
             $('.more').text('load more');
             $('.more').removeClass('disabled');
          }
          else
          {
             $('.more').removeClass('btn-warning');
             $('.more').addClass('btn-danger');
             $('.more').text('Albums End');
          }
        }
    });
});
$('.delete').click(function(e){
    e.preventDefault();
    var el = $(this);
   var id=$(this).attr('data-id');
    $.ajax({
        type: "delete",
        url: '/album/'+id,
        dataType: "json",
        success: function (response) {
            el.prev().parents('.col-md-4').remove();
        }
    });

});
$('.album').click(function(e){
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
