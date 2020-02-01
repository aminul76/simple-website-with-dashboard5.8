@extends('admin.master')

@section('content')

<div class="content">
          <div class="row">
            <div class="col-md-12">
            	 @include('admin.include.msg')
            	  <div class="container-fluid">
        	
              <div class="card">
              
                <div class="card-header card-header-primary">
	             
                	  
                  <h4 class="card-title ">Simple Table</h4>
               

                </div>
                <div class="card-body">
                  <div class="table-responsive">
                     <table id="table" class="table"  cellspacing="0" width="100%">
                                <thead class="text-primary">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Time and Date</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach($reservations as $key=>$reservation)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $reservation->name }}</td>
                                <td>{{ $reservation->phone }}</td>
                                <td>{{ $reservation->email }}</td>
                                <td>{{ $reservation->date_and_time }}</td>
                                <th>{{ $reservation->message }}</th>
                                <th>
                                    @if($reservation->status == true)
                                        <span class="label label-info">Confirmed</span>
                                    @else
                                        <span class="label label-danger">not Confirmed yet</span>
                                    @endif

                                </th>
                                <td>{{ $reservation->created_at }}</td>
                                <td>
                                    @if($reservation->status == false)
                                        <form id="status-form-{{ $reservation->id }}" action="{{ route('reservation.status',$reservation->id) }}" style="display: none;" method="POST">
                                            @csrf
                                        </form>
                                        <button type="button" class="btn btn-info btn-sm" onclick="if(confirm('Are you verify this request by phone?')){
                                                event.preventDefault();
                                                document.getElementById('status-form-{{ $reservation->id }}').submit();
                                                }else {
                                                event.preventDefault();
                                                }"><i class="material-icons">done</i></button>
                                    @endif
                                    <form id="delete-form-{{ $reservation->id }}" action="{{ route('reservation.destory',$reservation->id) }}" style="display: none;" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure? You want to delete this?')){
                                        event.preventDefault();
                                        document.getElementById('delete-form-{{ $reservation->id }}').submit();
                                    }else {
                                        event.preventDefault();
                                            }"><i class="material-icons">delete</i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <tr> {{ $reservations->links()}}</tr>
                  </div>
                </div>
              </div>
            </div>
           </div>
         </div>
    	</div>
@endsection
