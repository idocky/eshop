<?php

namespace App\Http\Controllers;

use App\Filters\ItemFilter;
use App\Models\admin\Category;
use App\Models\admin\Collection;
use App\Models\admin\Item;
use App\Models\admin\Slider;
use App\Models\admin\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CollectionController extends Controller
{
    public function index(ItemFilter $request)
    {

//        $items = Item::all()->where('is_published', 1);
        $items = Item::filter($request)->where('is_published', 1);
        $items = $items->paginate(12);

        $locale = (session('locale') == 'ua') ? 'ua' : 'ru';
        $categories = Category::all();
        $tags = DB::table('tags')
            ->orderBy('title_' . $locale)
            ->get();;
        $collections = Collection::all();

        return view('collection_list', ['items' => $items, 'locale' => $locale, 'collections' => $collections,
            'categories' => $categories, 'tags' => $tags]);
    }

    public function show($slug)
    {
        $item = Item::findBySlug($slug);
        $galleryPhoto = $item->gallery->pluck('photo');
        $item_sizes = $item->sizes()->orderBy('id', 'asc')->get();
        $locale = (session('locale') == 'ua') ? 'ua' : 'ru';
        $slider = Slider::all();

        return view('item_details', ['item' => $item, 'galleryPhoto' => $galleryPhoto, 'item_sizes' => $item_sizes, 'locale' => $locale, 'slider' => $slider]);
    }
}
