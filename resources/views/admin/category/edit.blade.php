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
                  
                     <form method="POST" action="{{ route('category.update',$category->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Title</label>
                                            <input type="text" class="form-control" name="name" value="{{ $category->name }}">
                                        </div>
                                    </div>
                                </div>
                               
                                <a href="{{ route('category.index') }}" class="btn btn-danger">Back</a>
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

