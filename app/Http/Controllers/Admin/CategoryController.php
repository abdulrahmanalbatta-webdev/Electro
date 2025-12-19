<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('image')->withCount('products')->latest()->paginate(10);
        return view('backend.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required|regex:/^[\p{Arabic}\d\s\p{P}]+$/u',
            'description_ar' => 'required|regex:/^[\p{Arabic}\d\s\p{P}]+$/u',
            'name_en' => 'nullable|regex:/^[A-Za-z\d\s\p{P}]+$/',
            'description_en' => 'nullable|regex:/^[A-Za-z\d\s\p{P}]+$/',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // $data = $request->except('_token', 'image');

        $name = [
            'en' => $request->name_en,
            'ar' => $request->name_ar,
        ];

        $description = [
            'en' => $request->description_en,
            'ar' => $request->description_ar,
        ];

        $category = Category::create([
            'name' => json_encode($name),
            'description' => json_encode($description),
        ]);

        // Add image an relation
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . rand() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);

            $category->image()->create([
                'path' => $filename
            ]);
        }

        flash()->success(__("Category created successfully"));
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('backend.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name_ar' => 'required|regex:/^[\p{Arabic}\d\s\p{P}]+$/u',
            'description_ar' => 'required|regex:/^[\p{Arabic}\d\s\p{P}]+$/u',
            'name_en' => 'nullable|regex:/^[A-Za-z\d\s\p{P}]+$/',
            'description_en' => 'nullable|regex:/^[A-Za-z\d\s\p{P}]+$/',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // $data = $request->except('_token', 'image');

        $name = [
            'en' => $request->name_en,
            'ar' => $request->name_ar,
        ];

        $description = [
            'en' => $request->description_en,
            'ar' => $request->description_ar,
        ];

        $category->update([
            'name' => json_encode($name),
            'description' => json_encode($description),
        ]);

        // $category->update($data);

        // Add image an relation
        if ($request->hasFile('image')) {

            if ($category->image && file_exists(public_path('images/' . $category->image->path))) {
                unlink(public_path('images/' . $category->image->path));
            }

            $file = $request->file('image');
            $filename = time() . '_' . rand() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);

            $category->image()->update([
                'path' => $filename
            ]);
        }

        flash()->success(__("Category updated successfully"));
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        File::delete(public_path('images/' . $category->image->path));

        $category->image()->delete();
        $category->delete();

        flash()->success(__("Category deleted successfully"));
        return redirect()->back();
    }
}
