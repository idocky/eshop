<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'main_slider';

    protected $fillable = ['item_id'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

}
