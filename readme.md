<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

working process
use laravel 5.8

1. install laravel
2.master the template
3. in web.php admin route group

Route::group(['prefix'=>'admin','middleware'=>'auth','namespace'=>'Admin'],function(){
 Route::get('/dashboard','DashboardController@index')->name('admin.dashboard');
});
 
that means middleare auth, namespace Admin folder,prefix admin

3.create DashboardController command line

php artisan make:controller Admin/DashboardController

in DashboardController create index method reaturn view page.

scecond 
4. after login redirect admin/dashboard so change in auth/login.blade.php set route

   protected $redirectTo = '/admin/dashboard';
5. single admin so of resistation route . in 

4th
6. in wep.php create route resource 

 Route::resource('/slider','SliderController');
7. create resource SliderController in command line
php artisan make:controller SliderController -r

show route list commmand line 

php artisan route:list

in SliderController use slider model
use App\Slider;
then return view

public function index()
    {
        $sliders=Slider::all();
        return view('admin.slider.index',compact('sliders'));
    }
8. create view page admin/slider/index.blade.php 

make table and use @foreach() @endforeach()
  <tbody>
   @foreach($sliders as $key=>$slider)
   <tr>
                          <td>
                            {{$key+1}}
                          </td>
                          <td>
                           {{$slider->title}}
                          </td>
</tr>
@endforeach

9. in header.blade.php create lougout function set logout route 
<li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="material-icons">exit_to_app</i>
                        Logout
                    </a>
                    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none">
                        @csrf
                    </form>
                </li>
that means when submit work logout-form and action route logout . 

10. in dashboard show slider and active 

<ul class="nav">
           <li class="{{ Request::is('admin/dashboard*') ? 'active': '' }}">
            <a class="nav-link" href="{{route('admin.dashboard')}}">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
that means if else condition request admin/dashboard is active show 

and set route siderbar  route('admin.dashboard');

11. use datatable.net use 


5th add new slider

12 in sliderController.php  create method

 return view('admin.slider.create');

13 create admin/slider/create.blade.php in form method=post, action={{route(slider.store)}} enctype=multipart/form-data.

 <form method="POST" action="{{ route('slider.store') }}" enctype="multipart/form-data">
  @csrf

14. in sliderController.php work store method save image and store all data

  public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'sub_title' => 'required',
            'image' => 'required|mimes:jpeg,jpg,bmp,png',
        ]);
        $image = $request->file('image');
        
        $slug = str_slug($request->title);

        if (isset($image))
            // that check korbe je $image variable set ase ki na.
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug .'-'. $currentDate .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
            //imagename sludg.date.unicid.name extensiton name
            if (!file_exists('uploads/slider'))
                //check file set ase ki na.
            {
                mkdir('uploads/slider', 0777 , true);
                // akti driktori create korbe & vlue dite hobe 0777
            }
            $image->move('uploads/slider',$imagename);
            // jodi file create theake ta hole move hobe uploads file a
        }else {
            $imagename = 'dafault.png';
        }

        $slider = new Slider();
        //variable->mysql database name=$request->form name
        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->image = $imagename;
        $slider->save();
        return redirect()->route('slider.index')->with('successMsg','Slider Successfully Saved');
    }
15. When input filed not fill error massge show . and insert show successfull massage

6th edit slider 

16. edit slider route that  slide.edit route pass id
<td><a href="{{route('slider.edit',$slider->id)}}" class="btn btn-info btn-sm">
<i class="material-icons">mode_edit</i> </a> </td>

17. in edit method find id data and return 

 $sliders=Slider::find($id);
 return view('admin.slider.edit',compact('sliders'));

18 in admin/slider/edit set value in form that show data.

value="{{ $slider->title }}"


18 SliderController in update method uddate data so find data set route in edit.blade.php and method put

  <form method="POST" action="{{ route('slider.update',$sliders->id) }}" enctype="multipart/form-data">
 @csrf
 @method('PUT')


  <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure? You want to delete this?')){
event.preventDefault();
document.getElementById('delete-form-{{ $slider->id }}').submit();
}else {
                         event.preventDefault();
 }"><i class="material-icons">delete</i></button>

19. show the massage create admin/include/msg 
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            <button type="button" aria-hidden="true" class="close" onclick="this.parentElement.style.display='none'">×</button>
            <span>
            <b> Danger - </b> {{ $error }}
			</span>
        </div>
    @endforeach
@endif

@if(session('successMsg'))
    <div class="alert alert-success">
        <button type="button" aria-hidden="true" class="close" onclick="this.parentElement.style.display='none'">×</button>
        <span>
		<b> Success - </b> {{ session('successMsg') }}
		</span>
    </div>
@endif

and where show the massgage @include('admin.include.msg) 
use 
7th 
18. delete the the slide find id and unlinck the path. in SliderController 
public function destroy($id)
    {
          $slider = Slider::find($id);
        if (file_exists('uploads/slider/'.$slider->image))
        {
            unlink('uploads/slider/'.$slider->image);
            //this unlink patah a
        }
        $slider->delete();
        return redirect()->back()->with('successMsg','Slider Successfully Deleted');
    }

9th slide show frontend 

19. create route in wep.php
Route::get('/','HomeController@index)->name('welcome');
20. in HomeController index method

$sliders=Slider::all();
return view('welcome',compact('sliders'));

21. in welcome.blade.php show the slide in main.css slide show
bt laravel foreach dont work main.css so css class cut and paste the welcome.blade.php

 <style>
        @foreach($sliders as $key=>$slider)
        
            .owl-carousel .owl-wrapper, .owl-carousel .owl-item:nth-child({{ $key + 1 }}) .item
            {
                background: url({{ asset('uploads/slider/'.$slider->image) }});
                background-size: cover;
            }
        @endforeach
    </style>
here this code. 
and foreach for title and sub_title that dynamic show

10th category crud

11th relation ship category item 
22. many to one realationship one category many item
create two model and migration and filed data .
php artisan make:model Category -m
php artisan make:model item -m

23.category many relaton in App/Categoy.php
 public function items()
    {
        return $this->hasMany('App\item');
    } 
24.item inverse relation in App/item.php
public function category()
    {
        return $this->belongsTo('App\Category');
    }
25. check relation 
php artisan tiker
App\Category::find(1);
App\Category::find(1)->items

10-15th crud item bt new learn relation and select category 

  <select class="form-control" name="category">
                                              @foreach($categories as $category )
                                              <option value="{{$category->id}}">{{$category->name}}</option>
                                              @endforeach
                                            </select>
it option select category show 
when item seclect work value 
 
15th show the forn page category and item 

26. in HomeController create index()

public function index()
    {
        $sliders=Slider::all();
        $categories=Category::all();
        $items=item::all();
        return view('welcome',compact('sliders','categories','items'));
    }
that get all and pass welcome page.

26. in welcome.php  

<li class="filter" data-filter="all">All</li>
                                    @foreach($categories as $category)
                                        <li class="filter" data-filter="#{{ $category->id }}">{{ $category->name }} <span class="badge">{{ $category->items->count() }}</span></li>
                                    @endforeach
that is data-filter="#{{ $category->id }}" link and next 


                        @foreach($items as $item)
                            <li class="item" id="{{ $item->category->id }}">
                                <!--data-filter="#{{ $category->id }}" it send id and  get id="{{ $item->category->id }}" it-->
                                <a href="#">
                                    <img src="{{ asset('uploads/item/'.$item->image) }}" class="img-responsive" alt="Item" style="height: 300px; width: 369px;" >

                                    <div class="menu-desc text-center">
                                            <span>
                                                <h3>{{ $item->name }}</h3>
                                                {{ $item->description }}
                                            </span>
                                    </div>
                                </a>
                                <h2 class="white">${{ $item->price }}</h2>
                            </li>
                        @endforeach


16th reservation system

27. use piker .use piker css and js and last use script code
use input class .form_datetime 
28. create ReservationController and model and database
 php artisan make:controller ReservationController
 php artisan make:model Reservation -m

filled the database and stor reservationControler

22th at the final clean the welcome page and 
in Admin\DashboardController 
$categoryCount = Category::count();
        $itemCount = item::count();
        $sliderCount = Slider::count();
        $reservations = Reservation::where('status',false)->get();
        
        return view('admin.home.home',compact('categoryCount','itemCount','sliderCount','reservations'));

in admin\home\home 

<h3 class="card-title">{{ $categoryCount }}/{{ $itemCount }}

that cout the the category

at last paginate the page 

in controller 
use Illuminate\Pagination\LengthAwarePaginator;
clear all 
$items=Item::paginate(15);

in index page

  <tr> {{ $items->links()}}</tr>

thant link tha page
