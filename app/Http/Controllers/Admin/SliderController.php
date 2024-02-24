<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Item;
use App\Models\admin\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $slider_items = Slider::all();

        return view('admin.slider.index', ['slider_items' => $slider_items]);
    }

    public function create()
    {

        return view('admin.slider.create');
    }

    public function store(Request $request)
    {
        Slider::create($request->all());
        return redirect()->route('slider.index');
    }

    public function destroy($id)
    {
        Slider::find($id)->delete();
        return redirect()->route('slider.index');
    }
}
