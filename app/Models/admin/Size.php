<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    public function items()
    {
        return $this->belongsToMany(
            Item::class,
            'items_sizes',
            'size_id',
            'item_id'
        );
    }
}
