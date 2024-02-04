<?php

namespace App\Http\Controllers;
use App\Models\Car;
use App\Models\Category;
use App\Models\Testimonial;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class HomeControllar extends Controller
{
    public function list(){
        $cars = Car::paginate(6);
        $testimonials = Testimonial:: take(3)->get();
        return view("listing", compact ('cars','testimonials'));
       // return view("listing");
        //return dd($cars);
    }
      public function contact(){
        return view("contact");
        //return dd($cars);
    }
     public function blog(){
        return view("blog");
    }
    public function about(){
        return view("about");
    }
     public function index(){
        $cars = Car::paginate(6);
         $testimonials = Testimonial:: take(3)->get();
        return view("index", compact ('cars','testimonials'));
      //  return view("index");
    }
     public function home(){
        return view("home");
    }
     public function testimonials(){
        $testimonials = Testimonial:: take(9)->get();
        return view("testimonials", compact ('testimonials'));
       // return view("testimonials");
    }
      public function single(string $id){
         $cars = Car::findOrFail($id);
         $categories = Category::select('id', 'categoryname')->get();
        return view("single" , compact('cars', 'categories'));
    }
    
}
