<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\admin\Category;
use App\Models\admin\Collection;
use App\Models\admin\Color;
use App\Models\admin\Composition;
use App\Models\admin\Item;
use App\Models\admin\Season;
use App\Models\admin\Size;
use App\Models\admin\Tag;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function index()
    {

        $items = Item::all();


        return view('admin.items.index', [
            'items' => $items,

        ]);
    }

    public function create()
    {
        $categories = Category::all()->pluck('title_ru', 'id');
        $tags = Tag::all()->pluck('title_ru', 'id');
        $seasons = Season::all()->pluck('title_ru', 'id');
        $collections = Collection::all()->pluck('title_ru', 'id');
        $sizes = Size::all()->pluck('name', 'id');
        $colors = Color::all()->pluck('title_ru', 'id');
        $composition = Composition::all()->pluck('composition_ru', 'id');

        return view('admin.items.create', ['categories' => $categories, 'tags' => $tags, 'seasons' => $seasons,
            'sizes' => $sizes, 'collections' => $collections, 'colors' => $colors, 'composition' => $composition
        ]);
    }

    public function store(StoreItemRequest $request)
    {
        $item = Item::add($request->all());
        $item->uploadPhoto($request->file("photo"));
        $item->setCategory($request->get("categories_id"));
        $item->setTags($request->get('tags_id'));
        $item->setSizes($request->get('sizes_id'));
        $item->setCollection($request->get('collection_id'));
        $item->setSeason($request->get('season_id'));
        $item->setColor($request->get('season_id'));
        $item->setComposition($request->get('composition_id'));
        $item->setGallery($request->file('gallery'));
        $item->toggleStatus($request->get('is_published'));

        return redirect()->route('items.index');
    }

    public function edit($id)
    {
        $item = Item::find($id);
        $categories = Category::all()->pluck('title_ru', 'id');
        $tags = Tag::all()->pluck('title_ru', 'id');
        $seasons = Season::all()->pluck('title_ru', 'id');
        $collections = Collection::all()->pluck('title_ru', 'id');
        $sizes = Size::all()->pluck('name', 'id');
        $colors = Color::all()->pluck('title_ru', 'id');
        $composition = Composition::all()->pluck('composition_ru', 'id');
        $galleryPhoto = $item->gallery->pluck('photo');

        return view('admin.items.edit', ['item' => $item, 'categories' => $categories, 'tags' => $tags, 'seasons' => $seasons,
            'sizes' => $sizes, 'collections' => $collections, 'colors' => $colors, 'composition' => $composition, 'galleryPhoto' => $galleryPhoto
        ]);
    }

    public function update(UpdateItemRequest $request, $id)
    {

        $item = Item::find($id);
        $item->edit($request->all());
        $item->uploadPhoto($request->file("photo"));
        $item->setCategory($request->get("categories_id"));
        $item->setTags($request->get('tags_id'));
        $item->setSizes($request->get('sizes_id'));
        $item->setCollection($request->get('collection_id'));
        $item->setSeason($request->get('season_id'));
        $item->setColor($request->get('season_id'));
        $item->setComposition($request->get('composition_id'));
        $item->setGallery($request->file('gallery'));
        $item->toggleStatus($request->get('is_published'));

        return redirect()->route('items.index');
    }

    public function destroy($id)
    {

        Item::find($id)->delete();
        return redirect()->route('items.index');
    }
}
