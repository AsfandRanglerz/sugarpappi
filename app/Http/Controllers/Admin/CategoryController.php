<?php

namespace App\Http\Controllers\Admin;

use App\Models\Topping;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\CategoryTopping;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $request = Category::create([
            'name' => $request->name,
        ]);
        return redirect()->route('category.index')->with(['status' => true, 'message' => 'Created Successfuly']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $category = Category::find($id);
        $category->update([
            'name' => $request->name,
        ]);
        return redirect()->route('category.index')->with(['status' => true, 'message' => 'Updated Successfuly']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::destroy($id);
        return redirect()->route('category.index')->with(['status' => true, 'message' => 'Deleted Successfuly']);
    }

    public function toppings($id)
    {
        $categoriesToppings = CategoryTopping::with('topping', 'category')->where('category_id' , $id)->get();
        // return $categoriesToppings;
        $categor_id = $id;
        $toppings = Topping::all();
        return view('admin.assignCategoryToTopping.index', compact('toppings', 'categor_id', 'categoriesToppings'));
    }
    public function toppingStore(Request $request)
    {
        $request->validate([
            'topping.*' => 'required',
            'topping' => 'required|array',
        ]);
        $categoryId = $request->input('category_id');
        $toppings = $request->input('topping');
        foreach ($toppings as $toppingid) {
            CategoryTopping::firstOrCreate([
                'category_id' => $categoryId,
                'topping_id' => $toppingid
            ]);
        }
        return redirect()->back()->with(['status' => true,'message' => 'Assigned Successfuly']);
    }
    public function toppingDestroy($id){
        CategoryTopping::destroy($id);
        return redirect()->back()->with(['status' => true,'message' => 'Deleted Successfuly']);
    }

}
