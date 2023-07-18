<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\productColor;

class Orderitem extends Model
{
    use HasFactory;
    protected $table = 'orders_items'; 

    protected $fillable = [
        'order_id',
        'product_id',
        'product_color_id',
        'quantity',
        'price'


    ];
//get the peoduct that owns to the orderitem
    public function product()
    {
        return $this->BelongsTo(Product::class,'product_id' , 'id');

    }
    
    //get the peoductColor that owns to the orderitem
    public function productColor()
    {
        return $this->BelongsTo(productColor::class,'product_color_id' , 'id');

    }
}
