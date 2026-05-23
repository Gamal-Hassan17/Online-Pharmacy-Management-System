<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class category_con extends Controller
{
    // عرض كل الكاتيجوري
    public function index()
    {
        $categories = Category::all();
        return view('Category\index_category', compact('categories'));
    }

    // صفحة إنشاء كاتيجوري
    public function create()
    {
        return view('Category\create_categoy');
    }

    // حفظ كاتيجوري جديد
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:categories,slug',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        Category::create($validated);

        return redirect()->route('category.index')
            ->with('success', 'Category added successfully!');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('category.edit_category', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => "required|string|unique:categories,slug,$id",
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $category = Category::findOrFail($id);
        $category->update($validated);

        return redirect()->route('category.index')
            ->with('success', 'Category updated successfully!');
    }
    public function toggle($id)
{
    $category = Category::findOrFail($id);

    $category->is_active = !$category->is_active;
    $category->save();

    return redirect()->back()->with('success', 'Status updated!');
}
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('category.index')
            ->with('success', 'Category deleted successfully!');
    }
}
