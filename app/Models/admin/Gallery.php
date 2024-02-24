<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['item_id', 'photo'];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

}
