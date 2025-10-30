<?php

namespace App\Http\Controllers\admin;

use App\Models\Menu;
use App\Models\MenuGallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class MenuGalleryController extends Controller
{
    public function menuGalleryIndex()
    {
        $menuGalleries = MenuGallery::orderBy('id', 'DESC')->get();
        return view('admin.menugallery.index', compact('menuGalleries'));
    }
    public function createmenuGallery()
    {
        return view('admin.menugallery.create');
    }
    public function storeImage(Request $request)
    {
        $request->validate([
            'image' => 'required',
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

        $menuGallery = MenuGallery::create([
            'image' => $image,
        ]);

        return redirect()->route('m-gallery.index')->with(['status' => true, 'message' => 'Created Successfully']);
    }
    public function editImage($id)
    {
        $menuGallery = MenuGallery::find($id);
        return view('admin.menugallery.edit', compact('menuGallery'));
    }
    public function updateImage(Request $request, $id)
    {
        $product = MenuGallery::find($id);

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
            $product->save();
        }
        return redirect()->route('m-gallery.index')->with(['status' => true, 'message' => 'Updated Successfully']);
    }
    public function destroy($id)
    {
        MenuGallery::destroy($id);
        return redirect()->route('m-gallery.index')->with(['status' => true, 'message' => 'Deleted Successfully']);
    }
}
