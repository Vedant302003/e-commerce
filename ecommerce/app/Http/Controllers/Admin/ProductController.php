<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'short_description' => 'required|string|max:1000',
            'description' => 'required|string',
            'preview_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name) . '-' . time();
        $product->price = $request->price;
        $product->sale_price = $request->sale_price;
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->status = $request->status;

        $uploadPath = public_path('uploads/products/');
        if (!File::isDirectory($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true, true);
        }

        if ($request->hasFile('preview_image')) {
            $image = $request->file('preview_image');
            $imageName = time() . '_preview_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadPath, $imageName);
            $product->preview_image = 'uploads/products/' . $imageName;
        }

        $multipleImages = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_multi_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move($uploadPath, $imageName);
                $multipleImages[] = 'uploads/products/' . $imageName;
            }
        }
        $product->images = $multipleImages;

        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'short_description' => 'required|string|max:1000',
            'description' => 'required|string',
            'preview_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        $product->name = $request->name;
        if ($product->isDirty('name')) {
            $product->slug = Str::slug($request->name) . '-' . time();
        }
        $product->price = $request->price;
        $product->sale_price = $request->sale_price;
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->status = $request->status;

        $uploadPath = public_path('uploads/products/');
        if (!File::isDirectory($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true, true);
        }

        // Handle Preview Image Update
        if ($request->hasFile('preview_image')) {
            // Delete old preview image
            if ($product->preview_image && File::exists(public_path($product->preview_image))) {
                File::delete(public_path($product->preview_image));
            }

            $image = $request->file('preview_image');
            $imageName = time() . '_preview_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadPath, $imageName);
            $product->preview_image = 'uploads/products/' . $imageName;
        }

        // Handle Multiple Images Update
        $currentImages = is_array($product->images) ? $product->images : [];

        // 1. Remove selected old images
        if ($request->has('remove_images')) {
            foreach ($request->remove_images as $imageToRemove) {
                if (in_array($imageToRemove, $currentImages)) {
                    // Remove from array
                    $currentImages = array_diff($currentImages, [$imageToRemove]);
                    // Delete from storage
                    if (File::exists(public_path($imageToRemove))) {
                        File::delete(public_path($imageToRemove));
                    }
                }
            }
            $currentImages = array_values($currentImages); // re-index
        }

        // 2. Add new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_multi_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move($uploadPath, $imageName);
                $currentImages[] = 'uploads/products/' . $imageName;
            }
        }
        
        $product->images = array_values($currentImages);
        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete preview image
        if ($product->preview_image && File::exists(public_path($product->preview_image))) {
            File::delete(public_path($product->preview_image));
        }

        // Delete multiple images
        $images = is_array($product->images) ? $product->images : [];
        foreach ($images as $img) {
            if (File::exists(public_path($img))) {
                File::delete(public_path($img));
            }
        }

        $product->delete();

        return back()->with('success', 'Product deleted successfully!');
    }
}
