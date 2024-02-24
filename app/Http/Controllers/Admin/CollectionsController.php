<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Collection;
use Illuminate\Http\Request;

class CollectionsController extends Controller
{
    public function index()
    {
        $collections = Collection::all();

        return view('admin.collections.index', ['collections' => $collections]);
    }

    public function create()
    {
        return view('admin.collections.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'title_ua' => 'required'
        ]);

        Collection::create($request->all());
        return redirect()->route('collections.index');
    }

    public function edit($id)
    {
        $collections = Collection::find($id);
        return view('admin.collections.edit', ['collections' => $collections]);

    }

    public function update(Request $request, $id)
    {
        $collections = Collection::find($id);
        $collections->update($request->all());

        return redirect()->route('collections.index');
    }

    public function destroy($id)
    {
        Collection::find($id)->delete();
        return redirect()->route('collections.index');
    }
}
