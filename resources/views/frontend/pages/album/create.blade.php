@extends('layouts.frontenduser')
@section('content')
<div class="container">
    <div class="card ">
      <div class="card-header">Create Album</div>
      <div class="card-body">
          <form action="/album" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="">Name</label>
              <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="Name" required>
              @error('name')
                <small  class="text-muted">{{$message}}</small>
              @enderror
            </div>
            <div class="form-group">
                <label for="">Images</label>
                <input type="file" name="images[]" class="form-control" accept="*/image" multiple  required>
                @error('images')
                  <small  class="text-muted">{{$message}}</small>
                @enderror
              </div>
            <div class="form-group">
                <label for="">Type</label>
                <select name="type" class="form-control" required>
                    <option value="">Select Type Of Album</option>
                    <option value="public"  {{old('type')=='public'?'selected':''}}>Public</option>
                    <option value="private" {{old('type')=='private'?'selected':''}}>Private</option>
                </select>
                @error('type')
                  <small  class="text-muted">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Save Album">
            </div>
          </form>
      </div>
    </div>
</div>
@endsection
