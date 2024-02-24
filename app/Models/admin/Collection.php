<?php

namespace App\Models\admin;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
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

    protected $fillable = ['title_ua', 'title_ru'];

    public function items()
    {
        return $this->hasMany(Item::class);
    }


}
