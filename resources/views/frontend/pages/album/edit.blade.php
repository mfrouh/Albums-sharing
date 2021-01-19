@extends('layouts.frontenduser')
@section('content')
<div class="container">
    <div class="card ">
      <div class="card-header">Update Album</div>
      <div class="card-body">
          <form action="/album/{{$album->id}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
              <label for="">Name</label>
              <input type="text" name="name" class="form-control" value="{{$album->name}}" placeholder="Name" required>
              @error('name')
                <small  class="text-muted">{{$message}}</small>
              @enderror
            </div>
            <div class="form-group">
                <label for="">Images</label>
                <input type="file" name="images[]" class="form-control" accept="*/image" multiple>
                @error('images')
                  <small  class="text-muted">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Type</label>
                <select name="type" class="form-control" required>
                    <option value="">Select Type Of Album</option>
                    <option value="public"  {{$album->type=='public'?'selected':''}}>Public</option>
                    <option value="private" {{$album->type=='private'?'selected':''}}>Private</option>
                </select>
                @error('type')
                  <small  class="text-muted">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Update Album">
            </div>
          </form>
      </div>
      <div class="card-body">
          <div class="row gallery">
           @foreach ($album->gallery as $image)
            <div class="col-md-4">
                <img src="{{asset($image->url)}}" height="75px" width="100px">
                <a href="javascript:void(0);" class="btn btn-danger btn-sm delete" data-id="{{$image->id}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
            </div>
           @endforeach
         </div>
      </div>
    </div>
</div>
@endsection
@section('js')
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('.gallery').on('click','.delete',function(e){
    e.preventDefault();
    var el = $(this);
   var id=$(this).attr('data-id');
    $.ajax({
        type: "delete",
        url: '/image/'+id,
        dataType: "json",
        success: function (response) {
            el.prev().parents('.col-md-4').remove();
        }
    });

});
</script>
@endsection
