@extends('admin.master')



@section('content')

<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
               @include('admin.include.msg')
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Simple Table</h4>
                 
                </div>
                <div class="card-body">
                  
                     <form method="POST" action="{{ route('item.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Title</label>
                                            <select class="form-control" name="category">
                                              @foreach($categories as $category )
                                              <option value="{{$category->id}}">{{$category->name}}</option>
                                              @endforeach
                                            </select>
                                        </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                     <div class="col-md-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">name</label>
                                            <input type="text" class="form-control" name="name">
                                        </div>
                                    </div>
                                  </div>
                                    <div class="row">
                                     <div class="col-md-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Description</label>
                                            <input type="text" class="form-control" name="description">
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                     <div class="col-md-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">price</label>
                                            <input type="text" class="form-control" name="price">
                                        </div>
                                    </div>
                                  </div>
                                     <div class="row">
                                    <div class="col-md-12">
                                            <label class="control-label">Image</label>
                                            <input type="file" name="image">
                                    </div>
                                </div>
                                
                                
                                <a href="{{ route('item.index') }}" class="btn btn-danger">Back</a>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                  </div>
                </div>
              </div>
            </div>
           </div>
         </div>
    	</div>

@endsection
