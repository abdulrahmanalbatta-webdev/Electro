<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::with(['category', 'createdBy', 'updatedBy', 'deletedBy']);

        // Filter by status
        if ($request->has('status') && $request->status == 'trashed') {
            $query->onlyTrashed();
        }

        // Filter by category
        if ($request->has('category_id') && $request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by date range
        if ($request->has('start_date') && $request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->has('end_date') && $request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $products = $query->latest()->paginate(10);
        $categories = Category::select('id', 'name')->get();

        return view('backend.products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        return view('backend.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required|regex:/^[\p{Arabic}\d\s\p{P}]+$/u',
            'description_ar' => 'required|regex:/^[\p{Arabic}\d\s\p{P}]+$/u',
            'name_en' => 'required|regex:/^[A-Za-z\d\s\p{P}]+$/',
            'description_en' => 'required|regex:/^[A-Za-z\d\s\p{P}]+$/',
            'price' => 'required',
            'quantity' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery' => 'required',
            'gallery.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        $name = [
            'en' => $request->name_en,
            'ar' => $request->name_ar,
        ];

        $description = [
            'en' => $request->description_en,
            'ar' => $request->description_ar,
        ];

        $product = Product::create([
            'name' => json_encode($name),
            'description' => json_encode($description),
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
            'created_by' => Auth::id(),
        ]);

        // Add image an relation
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . rand() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);

            $product->image()->create([
                'path' => $filename,
            ]);
        }

        foreach ($request->gallery as $img) {
            if ($request->hasFile('gallery')) {
                $file = $img;
                $filename = time() . '_' . rand() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images'), $filename);

                $product->gallery()->create([
                    'path' => $filename,
                    'type' => 'gallery'
                ]);
            }
        }


        flash()->success(__('Product Created successfully'));
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('backend.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::select('id', 'name')->get();
        return view('backend.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name_ar' => 'required|regex:/^[\p{Arabic}\d\s\p{P}]+$/u',
            'description_ar' => 'required|regex:/^[\p{Arabic}\d\s\p{P}]+$/u',
            'name_en' => 'required|regex:/^[A-Za-z\d\s\p{P}]+$/',
            'description_en' => 'required|regex:/^[A-Za-z\d\s\p{P}]+$/',
            'price' => 'required',
            'quantity' => 'required|integer',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery' => 'nullable',
            'gallery.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $name = [
            'en' => $request->name_en,
            'ar' => $request->name_ar,
        ];

        $description = [
            'en' => $request->description_en,
            'ar' => $request->description_ar,
        ];

        $product->update([
            'name' => json_encode($name),
            'description' => json_encode($description),
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
            'updated_by' => Auth::id(),
        ]);

        // Add image an relation
        if ($request->hasFile('image')) {
            if ($product->image) {
                File::delete(public_path('images/' . $product->image->path));
                $product->image()->delete();
                $product->image()->delete();
            }
            $file = $request->file('image');
            $filename = time() . '_' . rand() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);

            $product->image()->create([
                'path' => $filename,
                'type' => 'main'
            ]);
        }

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $filename = time() . '_' . rand() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images'), $filename);

                $product->image()->create([
                    'path' => $filename,
                    'type' => 'gallery'
                ]);
            }
        }

        $product->load(['image', 'gallery']);

        flash()->success(__('Product Updated successfully'));
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->update(['deleted_by' => Auth::id()]);
        $product->delete();

        flash()->success(__("Product deleted successfully"));
        return redirect()->back();
    }

    public function restore($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();

        flash()->success(__("Product restored successfully"));
        return redirect()->back();
    }

    public function forceDelete($id)
    {
        $product = Product::withTrashed()->findOrFail($id);

        if ($product->image) {
            File::delete(public_path('images/' . $product->image->path));
            $product->image()->delete();
        }

        foreach ($product->gallery as $img) {
            File::delete(public_path('images/' . $img->path));
        }

        $product->image()->delete();
        $product->gallery()->delete();
        $product->forceDelete();

        flash()->success(__("Product permanently deleted successfully"));
        return redirect()->back();
    }

    function delete_image($id)
    {
        $img = Image::findOrFail($id);

        File::delete(public_path('images/' . $img->path));

        $img->delete();

        return response()->json(['status' => 'success']);
    }
}
