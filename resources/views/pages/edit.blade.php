@extends('layouts.app')
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Page</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('pages.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  

    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('pages.update',$page->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Catogery</label>
                    <select name="category_id" class="form-control form-control-lg">
                        <option>Select Cateory</option>
                        @foreach($categories as $key=>$value)
                            <option value="{{$value->id}}" @if($value->id==$page->category_id) selected @endif>{{$value->name}}</option>
                        @endforeach                    
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input class="form-control form-control-lg" type="text" value="{{ $page->title }}" name="title" placeholder="Enter Title" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control form-control-lg ckeditor" value="{{ $page->description }}" col="5" rows="8" name="description"></textarea>
                </div>

                <div class="mb-3">
                   
                        <img src="{{url('/')}}/storage/uploads/{{$page->image}}" style="max-width:150px">

                </div>

                <div class="mb-3">
                    <label class="form-label">Image</label>
                    <input class="form-control form-control-lg" type="file" name="file"/>
                </div>
                <div class="mb-3">
                    <label class="form-label">Video url</label>
                    <input class="form-control form-control-lg" value="{{ $page->video_url }}" type="text" name="video_url" placeholder="Enter URL" />
                </div>
                
                <div class="text-left mt-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>
@endsection