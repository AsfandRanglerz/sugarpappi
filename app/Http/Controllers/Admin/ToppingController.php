<?php

namespace App\Http\Controllers\Admin;

use App\Models\Topping;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ToppingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $toppings = Topping::orderBy('id' , 'DESC')->get();
        return view('admin.topping.index' , compact('toppings'));
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

        $category = Topping::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);
        return redirect()->route('topping.index')->with(['status'=> true ,'message'=>'Created Successfuly']);
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
        $topping = Topping::find($id);
        return view('admin.topping.edit',compact('topping'));
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
        $category = Topping::find($id);

        $category->update([
            'name' => $request->name,
            'price' => $request->price,
        ]);
        return redirect()->route('topping.index')->with(['status' => true, 'message' => 'Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Topping::destroy($id);
        return redirect()->route('topping.index')->with(['status' => true, 'message' => 'Deleted Successfully']);
    }
}
