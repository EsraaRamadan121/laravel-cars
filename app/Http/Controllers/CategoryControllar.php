<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
class CategoryControllar extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::get();
        return view('admin.categories', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('admin.addCategory');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $messages= $this->messages();
       $data = $request->validate([
        'Categoryname' => 'required|max:255',
        ], $messages);
        Category::create($data);
        $categories = Category::get();
        return view('admin.categories', compact('categories'));
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
         $category = Category::findOrFail($id);
        return view('admin.editCategory', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $messages= $this->messages();
         $data = $request->validate([
           'Categoryname' => 'required|max:255',
         ], $messages);
         Category::where('id', $id)->update($data);
         return 'done';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::where('id', $id)->delete();
        return redirect()->route('createCategory');
    }
      public function messages(){
        return [
            'Categoryname.required'=>'Categoryname is required',
        ];
    }
}
