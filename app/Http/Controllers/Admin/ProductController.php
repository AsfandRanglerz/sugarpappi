<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\Product;
use App\Models\Topping;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ToppingProduct;
use App\Models\ProductVariants;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('variants')->latest()->get();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menu::all();
        $toppings = Topping::all();
        $categories = Category::all();
        return view('admin.product.create', compact('menus', 'toppings' , 'categories'));
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
            'menu_id' => 'required',
            'image' => 'required',
            'description' => 'required',
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('admin/assets/images/users/'), $filename);
            $image = 'public/admin/assets/images/users/' . $filename;
        } else {
            $image = 'public/admin/assets/images/users/1675332882.jpg';
        }
        $data = [
            'menu_id' => $request->menu_id,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image,
        ];
        if ($request->has('price')) {
            $data['price'] = $request->price;
        }
        $product = Product::create($data);
        if (($request->sizes && $request->prices)) {
            $sizes = $request->sizes;
            $prices = $request->prices;
            foreach ($sizes as $key => $size) {
                $productVariant = ProductVariants::create([
                    'product_id' => $product->id,
                    'size' => $size,
                    'price' => $prices[$key],
                ]);
            }
        }
        // Attach toppings to product
        $categoriesIds = $request->category_id;
        if ($categoriesIds) {
            foreach ($categoriesIds as $categoriesId) {
                $topping = ToppingProduct::create([
                    'category_id' => $categoriesId,
                    'product_id' => $product->id,
                ]);
            }
        }

        return redirect()->route('product.index')->with(['status' => true, 'message' => 'Product Created Successfully']);
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
        $product = Product::with('menu', 'variants','category')->find($id);
        $menus = Menu::all();
        $categoryIds = $product->category->pluck('category_id')->toArray();
        $categories = Category::all();
        return view('admin.product.edit', compact('product', 'menus', 'categories', 'categoryIds'));
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
        // return $request;
        $request->validate([
            'name' => 'required',
            'menu_id' => 'required',
            'description' => 'required',
        ]);

        $product = Product::with('variants')->find($id);

        if ($request->hasFile('image')) {
            $destination = 'public/admin/assets/img/users/' . $product->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/admin/assets/images/users', $filename);
            $image = 'public/admin/assets/images/users/' . $filename;
            $product->image = $image;
        }
        $product->menu_id = $request->menu_id;
        $product->name = $request->name;
        $product->description = $request->description;
        if ($request->has('price')) {
            $product->price = $request->price;
        }
        $product->save();
        if ($request->has('sizes') && $request->has('prices')) {
            $sizes = $request->sizes;
            $prices = $request->prices;
            foreach ($sizes as $key => $size) {
                if (isset($prices[$key])) {
                    $variantData = [
                        'size' => $size,
                        'price' => $prices[$key],
                    ];
                    if ($product->variants->count() > $key) {
                        $product->variants[$key]->update($variantData);
                    } else {
                        $productVariant = ProductVariants::create([
                            'product_id' => $product->id,
                            'size' => $size,
                            'price' => $prices[$key],
                        ]);
                    }
                }
            }
        }
        if ($product->category->count() > 0) {
            foreach ($product->category as $topping) {
                $topping->delete();
            }
        }
        $categoryIds = $request->category_id;
        if ($categoryIds) {
            foreach ($categoryIds as $categoryId) {
                $topping = ToppingProduct::create([
                    'category_id' => $categoryId,
                    'product_id' => $product->id,
                ]);
            }
        }
        return redirect()->route('product.index')->with(['status' => true, 'message' => 'Product Updated Successfully']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return redirect()->route('product.index')->with(['status' => true, 'message' => 'Product Deleted Successfully']);
    }

    public function status($id)
    {
        /*update status */

        $product = Product::find($id);
        $product->update(['status' => $product->status == 0 ? '1' : '0']);
        return redirect()->back()->with(['status' => true, 'message' => 'Updated Successfully']);
    }

    public function toggleFeatured($id)
    {
        $product = Product::findOrFail($id);
        $product->is_featured = !$product->is_featured;
        $product->save();

        $message = $product->is_featured
            ? 'Product marked as Featured successfully!'
            : 'Product unfeatured successfully!';

        return redirect()->back()->with('message', $message);
    }

}
