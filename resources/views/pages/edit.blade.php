@extends('layouts.app')
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Category</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('categories.index') }}"> Back</a>
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
  
    <form action="{{ route('categories.update',$category->id) }}" method="POST">
        @csrf
        @method('PUT')
   
         <div class="row">

            <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="{{ $category->name }}" class="form-control form-control-lg" placeholder="Name">
            </div>

            <div class="text-left mt-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
   
    </form>


@endsection