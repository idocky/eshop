<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Category;
use Illuminate\Http\Request;


class CategoriesController extends Controller
{
    public function index()
    {

        $categories = Category::all();

        return view('admin.categories.index', [
            'categories' => $categories,

        ]);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title_ua' => 'required'
        ]);

        Category::create($request->all());
        return redirect()->route('categories.index');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit', ['category' => $category]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title_ua' => 'required'
        ]);

        $category = Category::find($id);
        $category->update($request->all());

        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {

        Category::find($id)->delete();
        return redirect()->route('categories.index');
    }

}
