<?php

namespace App\Http\Controllers;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Traits\Common;

class TestimonialController extends Controller
{
         use Common;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $testimonials = Testimonial::get();
        return view('admin.testimonials', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('admin.addTestimonials');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $messages= $this->messages();
       $data = $request->validate([
        'name' => 'required|max:255',
        'position' => 'required',
        'content' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
], $messages);
 $data['published']= isset ($request['published']);
 $data['image'] = $this->uploadFile($request->image, 'assets\images');
 Testimonial::create($data);
       return'done';
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
          $testimonial = Testimonial::findOrFail($id);
        return view('admin.editTestimonials', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $data = $request->validate([
        'name' => 'required|max:255',
        'position' => 'required',
        'content' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
      $data['published']= isset ($request['published']);
        if(isset($request->image)){
            $data['image'] = $this->uploadFile($request->image, 'assets\images');
        }
        Testimonial::where('id', $id)->update($data);
        return 'done';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Testimonial::where('id', $id)->delete();
        return redirect()->route('createtestimonials');
    }
      public function messages(){
        return [
            'Categoryname.required'=>'Categoryname is required',
        ];
    }
}
