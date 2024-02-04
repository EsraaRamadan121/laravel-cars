<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CategoryControllar;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\HomeControllar;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\LoginController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});
Route::get('test', function () {
    return 'welcome';
});
Route::group(
    ['prefix' => 'admin', 'middleware' => ['verified']],
    function () { 
Route::get('users',[UserController::class,'index'])->name('users');
Route::get('edituser/{id}', [UserController::class, 'edit']);
Route::put('updateuser/{id}', [UserController::class, 'update'])->name('updateUsers');
/*--------------------------------------------------------------------------*/
Route::get('addCar',[CarController::class,'create'])->name('createCar');
Route::post('/admin/addCar',[CarController::class,'store'])->name('carstore');
Route::get('cars',[CarController::class,'index'])->name('Cars');
Route::get('editCar/{id}', [CarController::class, 'edit'])->middleware('verified');
Route::put('updateCar/{id}', [CarController::class, 'update'])->name('updateCar');
Route::get('deleteCar/{id}', [CarController::class, 'destroy'])->name('deleteCar');
/*--------------------------------------------------------------------------*/
Route::get('Category',[CategoryControllar::class,'create'])->name('createCategory');
Route::post('Category',[CategoryControllar::class,'store'])->name('Categorystore');
Route::get('categories',[CategoryControllar::class,'index'])->name('categories');
Route::get('editCategory/{id}', [CategoryControllar::class, 'edit']);
Route::put('updatecategory/{id}', [CategoryControllar::class, 'update'])->name('updatecategory');
Route::get('deleteCategory/{id}', [CategoryControllar::class, 'destroy'])->name('deleteCategory');
/*--------------------------------------------------------------------------*/
Route::get('addtestimonials',[TestimonialController::class,'create'])->name('createtestimonials') ;
Route::post('/admin/addtestimonials',[TestimonialController::class,'store'])->name('testimonialstore');
Route::get('testimonials',[TestimonialController::class,'index'])->name('Testimonials');
Route::get('editTestimonials/{id}', [TestimonialController::class, 'edit']);
Route::put('updateTestimonials/{id}', [TestimonialController::class, 'update'])->name('updateTestimonials');
Route::get('deleteTestimonials/{id}', [TestimonialController::class, 'destroy'])->name('deleteTestimonials');
/*--------------------------------------------------------------------------*/
Route::get('addmessage', [MessageController::class, 'create']);
Route::post('contact',[MessageController::class,'store'])->name('message');
Route::get('messages',[MessageController::class,'index'])->name('messages');
Route::get('showMessage/{id}',[MessageController::class,'show'])->name('show');
Route::get('deletemessages/{id}', [MessageController::class, 'destroy'])->name('deletemessages');
Route::get('unreadCount/{id}',[MessageController::class,'unreadCount'])->name('unreadCount');

 });

/*--------------------------------------------------------------------------*/
Route::get('listing', [HomeControllar::class, 'list'])->name('SHOW');
Route::get('blog', [HomeControllar::class, 'blog'])->name('blog');
Route::get('about', [HomeControllar::class, 'about'])->name('about');
Route::get('index', [HomeControllar::class, 'index'])->name('index');
Route::get('contact', [HomeControllar::class, 'contact'])->name('contact');
Route::get('home', [HomeControllar::class, 'home'])->name('home');
Route::get('testimonials', [HomeControllar::class, 'testimonials'])->name('testimonials');
Route::get('single/{id}', [HomeControllar::class, 'single'])->name('single');


Auth::routes(['verify'=>true]);
Route::get('addUser',[UserController::class,'create'])->name('createuser');
Route::post('/admin/addUser',[UserController::class,'store'])->name('userstore');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
