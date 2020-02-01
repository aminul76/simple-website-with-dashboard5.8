<?php

namespace App\Http\Controllers\Admin;
use App\Notifications\ReservationConfirmed;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Reservation;
use Illuminate\Support\Facades\Notification;
use Illuminate\Pagination\LengthAwarePaginator;
class ReservationController extends Controller
{
    public function index()
    {
    	$reservations= Reservation::paginate(15);
    	return view('admin.reserv.index',compact('reservations'));
    }
    
    public function status($id){
        $reservation = Reservation::find($id);
        $reservation->status = true;
        $reservation->save();
      
       
        return redirect()->back();
    }
    public function destory($id){
        Reservation::find($id)->delete();
       
        return redirect()->back();
    }
}
