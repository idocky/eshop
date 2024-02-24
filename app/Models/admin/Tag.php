<?php

namespace App\Models\admin;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    use Sluggable;

    public $timestamps = false;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title_ua'
            ]
        ];
    }

    protected $fillable = ['title_ua', 'color', 'title_ru', 'text_color'];

    public function items()
    {
        return $this->belongsToMany(
            Item::class,
            'items_tags',
            'tag_id',
            'item_id'
        );
    }

}
