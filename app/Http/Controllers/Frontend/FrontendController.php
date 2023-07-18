<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Product;

class FrontendController extends Controller
{
    public function index()
    {  
        $sliders = Slider::where('status','0')->get(); 
        $trendingProduct = Product::where('trending','1')->latest()->take(15)->get();
        $newArrivelProducts = Product::latest()->take(14)->get();
        $featuredProducts = Product::where('featured','1')->latest()->take(14)->get();
        return view('frontend.index',compact('sliders','trendingProduct','newArrivelProducts','featuredProducts'));
    }

    //57
    
    public function searchProducts(Request $request){

        if($request->search){
            $searchProducts = Product::where('name','LIKE','%'.$request->search.'%')->latest()->paginate(15); 
            return view('frontend.pages.search',compact('searchProducts'));  
        }
        else{
            return redirect()->back()->with('message', 'Empty Search');
 
        }
    }

//51
    public function featuredProducts()
    {

        $featuredProducts = Product::where('featured','1')->latest()->get();
        return view('frontend.pages.featured-products',compact('featuredProducts'));

    }
//50
    public function newArrival()
    {
        $newArrivelProducts = Product::latest()->take(3)->get();
        return view('frontend.pages.new-arrival',compact('newArrivelProducts'));

    }

    public function categories()
    {
        $categories = Category::where('status','0')->get(); 
        return view('frontend.collections.category.index',compact('categories'));

    }

    public function products($category_slug)
    {
        $category = Category::where('slug',$category_slug)->first();
        
        if($category){
             return view('frontend.collections.products.index',compact('category'));
            
        }else{
            return redirect()->back();
        }
    }

    public function productView(string $category_slug,string $product_slug)
    {
        $category = Category::where('slug',$category_slug)->first();
        
        if($category){
            $product = $category->products()->where('slug',$product_slug)->where('status','0')->first();
            if($product)
            {
                return view('frontend.collections.products.view',compact('product','category'));

            }
            else{
                return redirect()->back();

            }

        }else{
            return redirect()->back();
        }

    }
    public function thankyou()
    {
        return view('frontend.thank-you');
    }

}
