<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Banner;
use Illuminate\Http\Request;

class BannersController extends Controller
{
    public function index()
    {
        $banners = Banner::all();

        return view('admin.banners.index', ['banners' => $banners]);
    }


    public function edit($id)
    {
        $banners = Banner::find($id);
        return view('admin.banners.edit', ['banners' => $banners]);

    }

    public function update(Request $request, $id)
    {
        $banners = Banner::find($id);
        $banners->update($request->all());

        return redirect()->route('banners.index');
    }

}
