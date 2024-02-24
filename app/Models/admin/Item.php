<?php

namespace App\Models\admin;

use App\Filters\QueryFilter;
use App\Models\Order;
use Cviebrock\EloquentSluggable\Sluggable;
use http\Env\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Item extends Model
{
    use HasFactory;
    use Sluggable;

    const IS_DRAFT = 0;
    const IS_PUBLIC = 1;

    public $timestamps = false;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title_ua'
            ]
        ];
    }

    protected $fillable = ['title_ua', 'title_ru', 'price', 'description_ua', 'description_ru', 'discount'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }

    public function collection()
    {
        return $this->belongsTo(Collection::class, 'collection_id');
    }

    public function season()
    {
        return $this->belongsTo(Season::class, 'season_id');
    }

    public function composition()
    {
        return $this->belongsTo(Composition::class, 'composition_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function gallery()
    {
        return $this->hasMany(Gallery::class, 'item_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'items_tags',
            'item_id',
            'tag_id'
        );
    }

    public function sizes()
    {
        return $this->belongsToMany(
            Size::class,
            'items_sizes',
            'item_id',
            'size_id'
        );
    }


    public static function add($fields)
    {
        $item = new static;
        $item->fill($fields);
        $item->save();

        return $item;
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }

    public function uploadGallery(Request $request)
    {
        foreach ($request->file('gallery') as $file)
        {
            $file->storeAs('uploads/');
        }
    }

    public function uploadPhoto($photo)
    {
        if($photo == null){return;}
        $this->removePhoto();
        $filename = Str::random(10) . '.' . $photo->extension();
        $photo->storeAs('uploads', $filename);
        $this->photo = $filename;
        $this->save();
    }

    public function removePhoto()
    {
        if($this->photo != null)
        {
            Storage::delete('uploads/' . $this->photo);
        }
    }

    public function getPhoto()
    {
        if($this->photo == null){
            return 'img/no-image.png';
        }

        return 'uploads/' . $this->photo;
    }

    public function setCategory($id)
    {
        if($id == null){return;}

        $this->categories_id = $id;
        $this->save();
    }

    public function setSeason($id)
    {
        if($id == null){return;}

        $this->season_id = $id;
        $this->save();
    }

    public function setCollection($id)
    {
        if($id == null){return;}

        $this->collection_id = $id;
        $this->save();
    }

    public function setComposition($id)
    {
        if($id == null){return;}

        $this->composition_id = $id;
        $this->save();
    }

    public function setColor($id)
    {
        if($id == null){return;}

        $this->color_id = $id;
        $this->save();
    }

    public function setTags($ids)
    {
        if($ids == null){return;}

        $this->tags()->sync($ids);
    }

    public function setSizes($ids)
    {
        if($ids == null){return;}

        $this->sizes()->sync($ids);
    }

    public function setGallery($photos)
    {
        if($photos == null){return;}
        foreach ($photos as $photo)
        {
            $filename = Str::random(10) . '.' . $photo->extension();
            $photo->storeAs('uploads', $filename);
            Gallery::create([
                'item_id' => $this->id,
                'photo' => $filename
            ]);
        }
    }

    public function setDraft()
    {
        $this->is_published = Item::IS_DRAFT;
        $this->save();
    }

    public function setPublic()
    {
        $this->is_published = Item::IS_PUBLIC;
        $this->save();
    }

    public function toggleStatus($value)
    {
        if($value == null)
        {
            return $this->setDraft();
        }
        else
        {
            return $this->setPublic();
        }
    }

    public function getCategoryTitleRu()
    {
        return ($this->category != null)
            ? $this->category->title_ru
            : 'Без категории';
    }

    public function getCollectionTitleRu()
    {
        return ($this->collection != null)
            ? $this->collection->title_ru
            : 'Без коллекции';
    }

    public static function findBySlug($slug)
    {
        $item = Item::where('slug', $slug)->first();

        return $item;
    }

    public function findSize($id)
    {
        if($id != null) {
            return Size::find($id)->name;
        }
        else {
            return '';
        }
    }

    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        return $filter->apply($builder);
    }


}
