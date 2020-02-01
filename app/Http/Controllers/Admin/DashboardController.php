<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\item;
use App\Reservation;
use App\Slider;

class DashboardController extends Controller
{
    public function index()
    {
    	$categoryCount = Category::count();
        $itemCount = item::count();
        $sliderCount = Slider::count();
        $reservations = Reservation::where('status',false)->get();
        
        return view('admin.home.home',compact('categoryCount','itemCount','sliderCount','reservations'));
    	
    }
}
