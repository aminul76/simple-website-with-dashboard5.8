<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use App\Category;
use App\item;
class HomeController extends Controller
{
   
    public function index()
    {
        $sliders=Slider::all();
        $categories=Category::all();
        $items=item::all();
        return view('welcome',compact('sliders','categories','items'));
    }
}
