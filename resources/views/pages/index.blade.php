@extends('layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <!-- <h2>Laravel 9 CRUD Example from scratch - ItSolutionStuff.com</h2> -->
            </div>
            <div class="pull-right" style="margin-bottom:10px;">
                <a class="btn btn-success" href="{{ route('pages.create') }}"> Create New page</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   

    <div class="row">
        <div class="col-12 col-lg-12 col-xxl-9 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <h5 class="card-title mb-0">Page Management</h5>
                </div>
                <table class="table table-hover my-0">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th width="280px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    

                        @foreach ($pages as $page)
                        <tr>
                            <td class="d-none d-xl-table-cell">{{ ++$i }}</td>
                            <td class="d-none d-xl-table-cell">{{ $page->title }}</td>
                            <td class="d-none d-xl-table-cell"><img src="{{url('/')}}/storage/uploads/{{ $page->image }}" style='max-width:100px'></td>
                            <td class="d-none d-xl-table-cell">
                                <form action="{{ route('pages.destroy',$page->id) }}" method="POST">
                
                                    <a class="btn btn-info" href="{{ route('pages.show',$page->id) }}">Show</a>
                    
                                    <a class="btn btn-primary" href="{{ route('pages.edit',$page->id) }}">Edit</a>
                
                                    @csrf
                                    @method('DELETE')
                    
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  
    {!! $pages->links() !!}
      
@endsection