<?php

namespace App\Models;

use App\Models\admin\Item;
use App\Models\admin\Size;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['full_name', 'phone', 'town', 'department', 'email', 'commentary', 'town_ref', 'area'];

    public static function add($fields)
    {
        $order = new static;
        $order->fill($fields);
        $order->save();

        return $order;
    }

    public function status()
    {
        return $this->belongsTo(Oder_status::class, 'status_id');
    }

    public function items()
    {
        return $this->belongsToMany(
            Item::class,
            'order_list',
            'order_id',
            'item_id'
        )->withPivot('quantity', 'size_id');
    }



    public function setStatus($id)
    {
        if($id == null){return;}

        $this->status_id = $id;
        $this->save();
    }

    public function calculateTotalPrice()
    {
        $cart = session('cart');
        $total = 0;
        foreach ($cart as $item)
        {
            if($item['product']->discount != 0)
            {
                $total += ($item['product']->price - $item['product']->discount) * $item['quantity'];
            }
            else
            {
                $total += $item['product']->price * $item['quantity'];
            }
        }
        $this->total_price = $total;
        $this->save();

        return $total;
    }

    public function addUserId()
    {
        if(Auth::check()) {
            $this->user_id = Auth::user()->id;
            $this->save();
        }
    }

    public function setItems()
    {
        $cart = session('cart');

        foreach ($cart as $name => $item) {
            $parts = explode("_", $name);
            $this->items()->attach($parts[0], [
                'quantity' => $item['quantity'],
                'size_id' => $parts[1]
            ]);
        }
    }


}
