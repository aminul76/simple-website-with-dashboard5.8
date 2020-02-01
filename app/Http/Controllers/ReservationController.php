<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Reservation;

class ReservationController extends Controller
{
   public function reserve(Request $request)
   {
   	 $this->validate($request,[
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'dateandtime' => 'required'
        ]);
        $reservation = new Reservation();
        $reservation->name = $request->name;
        $reservation->phone = $request->phone;
        $reservation->email = $request->email;
        $reservation->date_and_time = $request->dateandtime;
        $reservation->message = $request->message;
        $reservation->status = false;
        $reservation->save();
        return redirect()->back()->with('successMsg','massage sent  Successfully');
   }
}
