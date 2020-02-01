@extends('admin.master')

@section('content')

<div class="content">
          <div class="row">
            <div class="col-md-12">
            	 @include('admin.include.msg')
            	  <div class="container-fluid">
        		<a class="nav-link" href="{{route('item.create')}}">
	              <i class="material-icons">add_box</i>
	              add new categorly
	            </a>
              <div class="card">
              
                <div class="card-header card-header-primary">
	             
                	  
                  <h4 class="card-title ">Simple Table</h4>
               

                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    	 <table id="example" class="display" style="width:100%">
                                <thead class="text-primary">
                        <th>
                          ID
                        </th>
                        <th>
                          name
                        </th> 
                        <th>
                          category name
                        </th> 
                        <th>
                          description
                        </th> 
                         <th>
                          image
                        </th> 
                        <th>
                          price
                        </th>
                     
                        <th>
                          Creted At
                        </th>
                        <th>
                          Update At
                        </th>
                        <th>
                          Action
                        </th>
                      </thead>
                      <tbody>
                      	  @foreach($items as $key=>$item)
                          <tr>
                          <td>{{ $key + 1 }}</td>
                          <td>{{ $item->name }}</td>
                         <td>{{ $item->category->name }}</td>

                          <td>{{ $item->description }}</td>
                          <td><img  class="img-responsive img-thumbnail" style="height: 100px; width: 100px" alt="" src="{{asset('uploads/item/'.$item->image)}}"> </td>
                          <td>{{ $item->price }}</td>
                          <td>{{ $item->created_at }}</td>
                          <td>{{ $item->updated_at }}</td>

                        <td>
                        	 <a href="{{route('item.edit',$item->id)}}" class="btn btn-info btn-sm"><i class="material-icons">mode_edit</i> </a>

                       <form id="delete-form-{{ $item->id }}" action="{{ route('item.destroy',$item->id) }}" style="display: none;" method="POST">
                        @csrf
                       @method('DELETE')
					           </form>
                        <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure? You want to delete this?')){
                        event.preventDefault();
                        document.getElementById('delete-form-{{ $item->id }}').submit();
                       }else {
                         event.preventDefault();
                          }"><i class="material-icons">delete</i></button>
                        </td>
                        </tr>
 						           @endforeach
            
                      </tbody>
                
                    </table>
             <tr> {{ $items->links()}}</tr>

                  </div>
                </div>
              </div>
            </div>
           </div>
         </div>
    	</div>
@endsection
