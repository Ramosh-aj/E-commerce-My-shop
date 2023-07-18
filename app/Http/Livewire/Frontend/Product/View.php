<?php

namespace App\Http\Livewire\Frontend\Product;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;
use App\Models\Cart;


class View extends Component
{
    
    public $category,$product,$prodColorSelectedQuantity,$quantityCount=1,$productColorId;

    public function addToWishList($productId)
    {
        if(Auth::check())
            {
                //To check if we click twice dont add the product two time just one
                if(Wishlist::where('user_id',auth()->user()->id)->where('product_id' ,$productId)->exists())
                    {
                        session()->flash('message', 'Already added  to Wishlist');
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Already added to Wishlist',
                            'type' => 'warning',
                            'status' => 409 ,
                        ]);
                        return false;

                    }

                //add to wishlist
                Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' =>$productId,
                ]);
                $this->emit('wishlistAddedUpdated');
                session()->flash('message', 'Wishlist Added successfuly');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Wishlist Added successfuly',
                    'type' => 'success',
                    'status' => 200,
                ]);
            }
        else
            {
                session()->flash('message', 'Please Login To Continue');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Please Login To Continue',
                    'type' => 'info',
                    'status' => 401,
                ]);
                return false;

            }  
    }

        public function mount($category,$product)
    {
        $this->category = $category;
        $this->product = $product;
        
        
    }

    public function colorSelected($productColorId)
    {
       $this->productColorId = $productColorId;
       $productColor = $this->product->productColors()->where('id',$productColorId)->first();
       $this->prodColorSelectedQuantity = $productColor->quantity;

       if($this->prodColorSelectedQuantity == 0){
        $this->prodColorSelectedQuantity = 'outOfStock';
       }
    }
    
    public function render()
    {
        return view('livewire.frontend.product.view',[
            'product' => $this->product,
            'category' => $this->category,
        ]);
       
    }

    public function decrementQuantity()
    {
        if($this->quantityCount > 1){
            $this->quantityCount--;

        }
    }

    public function incrementQuantity()
    {
        if($this->quantityCount < 10){
            $this->quantityCount++;


        }
    }

    public function addToCart(int $productId)
    {   
        if(Auth::check()){
           if($this->product->where('id',$productId)->where('status' , '0')->exists()){
                
                //Cheack The product qolour quantity and add to cart
                if($this->product->productColors()->count() > 1)
                {
                    //dd('product colour inside ');
                    if($this->prodColorSelectedQuantity != NULL)
                    {
                        if(Cart::where('user_id',auth()->user()->id)
                                ->where('product_id', $productId)
                                ->where('product_color_id', $this->productColorId)
                                ->exists())
                        {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Product Already Added',
                                'type' => 'warning',
                                'status' => 200,
                            ]);
                        }
                        else
                        {
                            $productColor = $this->product->productColors()->where('id',$this->productColorId)->first();
                            if($productColor->quantity > 0 ){
    
                                if($productColor->quantity > $this->quantityCount)
                                {
                                        //insert Product To cart
                                        Cart::create([
                                            'user_id' => auth()->user()->id,
                                            'product_id' => $productId,
                                            'product_color_id' =>   $this->productColorId,
                                            'quantity' =>  $this->quantityCount,
                                        ]);
                                        $this->emit('CartAddedUpdated');
                                        $this->dispatchBrowserEvent('message', [
                                            'text' => 'Product Added to Cart',
                                            'type' => 'success',
                                            'status' => 200,
                                        ]);
                                }
            
                                        //the quantity less than the order 
                                else
                                {
                                    $this->dispatchBrowserEvent('message', [
                                        'text' => 'Only'.$productColor->quantity.'َQuantity Available',
                                        'type' => 'warning',
                                        'status' => 404,
                                    ]);
                                }
                            }
                            else
                            {
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'Out Of Stock',
                                    'type' => 'warning',
                                    'status' => 404,
                                ]);
        
    
                            }
                        }

                    }
                    else
                    {
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Select Your Product Color',
                            'type' => 'info',
                            'status' => 404,
                        ]);
                    }

                }
                else
                {
                    if(Cart::where('user_id',auth()->user()->id)->where('product_id', $productId)->exists())
                    {
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Product Already Added',
                            'type' => 'warning',
                            'status' => 200,
                        ]);
                    }
                    else
                    {
                        if($this->product->quantity > 0){
                        
                            if($this->product->quantity > $this->quantityCount)
                            {
                                    //insert Product To cart
                                    Cart::create([
                                        'user_id' => auth()->user()->id,
                                        'product_id' => $productId,
                                        'quantity' =>  $this->quantityCount,
                                    ]);
                                    
                                    $this->emit('CartAddedUpdated');
                                    $this->dispatchBrowserEvent('message', [
                                        'text' => 'Product Added to Cart',
                                        'type' => 'success',
                                        'status' => 200,
                                    ]);
                            }
        
                                    //the quantity less than the order 
                            else
                            {
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'Only'.$this->product->quantity.'َQuantity Available',
                                    'type' => 'warning',
                                    'status' => 404,
                                ]);
                            }
                        }
        
                                //the quantity of the product is over 
                                //The product is out of stock 
                        else{
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Out Of Stock',
                                'type' => 'warning',
                                'status' => 404,
                            ]);
                        }   
                        }
                }
           }
           
           else{
            $this->dispatchBrowserEvent('message', [
                'text' => 'Product Does not exists',
                'type' => 'warning',
                'status' => 404,
            ]);
           }
        }else{
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please Login to add to cart',
                'type' => 'info',
                'status' => 401,
            ]);
        }  
        }
       
    }

