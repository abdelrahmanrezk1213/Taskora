<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(10);

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        // /** @var User $user */
        // $user = Auth::user();

        // if ($user->role !== 'admin') {
        //     abort(403, 'Only admins can create categories.');
        // }

        return view('categories.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        // /** @var User $user */
        // $user = Auth::user();

        // if ($user->role !== 'admin') {
        //     abort(403, 'Only admins can create categories.');
        // }

        Category::create($request->validated());

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category Created Successfully');
    }

    public function edit(Category $category)
    {
        // /** @var User $user */
        // $user = Auth::user();

        // if ($user->role !== 'admin') {
        //     abort(403, 'Only admins can create categories.');
        // }

        return view('categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        // /** @var User $user */
        // $user = Auth::user();

        // if ($user->role !== 'admin') {
        //     abort(403, 'Only admins can create categories.');
        // }

        $category->update($request->validated());

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category Updated Successfully.');
    }

    public function destroy(Category $category)
    {
        // /** @var User $user */
        // $user = Auth::user();

        // if ($user->role !== 'admin') {
        //     abort(403, 'Only admins can create categories.');
        // }

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category Deleted Successfully.');
    }
}
