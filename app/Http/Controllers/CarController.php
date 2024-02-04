<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Category;
use App\Traits\Common;
class CarController extends Controller
{
     use Common;
    public function index()
    {
         $cars = Car::get();
        return view('admin.cars', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $categories = Category::select('id', 'categoryname')->get();
        return view('admin.addCar', compact('categories'));
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) 
    { 
        $messages= $this->messages();
       $data = $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
        'luggage' => 'required',
        'doors' => 'required',
        'passengers' => 'required',
        'price' => 'required',
        'category_id' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
], $messages);
 $data['active']= isset ($request['active']);
 $data['image'] = $this->uploadFile($request->image, 'assets\images');
 Car::create($data);
return'done';

    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $car = Car::findOrFail($id);
        $categories = Category::select('id', 'categoryname')->get();
        return view('admin.editCar',compact('car','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $data = $request->validate([
        'title' => 'required',
        'content' => 'required',
        'luggage' => 'required',
        'doors' => 'required',
        'passengers' => 'required',
        'price' => 'required',
        'category_id' => 'required',
        'image' => 'sometimes|mimes:png,jpg,jpeg|max:2048',
        ]);
        $data['active']= isset ($request['active']);
        if(isset($request->image)){
            $data['image'] = $this->uploadFile($request->image, 'assets\images');
        }
        Car::where('id', $id)->update($data);
        return 'done';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Car::where('id', $id)->delete();
        return redirect()->route('createCategory');
    }
    public function messages(){
        return [
            'title.required'=>'Title is required',
            'content.required'=> 'should be text',
        ];
    }
}


