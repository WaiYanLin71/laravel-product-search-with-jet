<?php

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',function(){
    $product = Product::with('brandCategory','brandCategory.category','brandCategory.brand')
    ->when(request('free_search'),function($query) {
        $query->where('name','like','%'.request('free_search').'%')
        ->orWhereHas('brandCategory.brand',function($query){
            $query->where('name','like','%'.request('free_search').'%');
        })
        ->orWhereHas('brandCategory.category',function($query){
            $query->where('name','like','%'.request('free_search').'%');
        });
    },function($query){
        $query->when(request('brand_id') ?? false,function($query){
            $query->whereHas('brandCategory.brand',function($query){
                $query->where('id',request('brand_id'));
            });
        })
        ->when(request('category_id') ?? false,function($query){
            $query->whereHas('brandCategory.category',function($query){
                $query->where('id',request('category_id'));
            });
        });
    })
    ->when(request('stock'),function($query){
        if(request('stock') === 'unstock') {
           return $query->where('quantity',0);
        }
        if(request('stock') === 'stock'){
            return $query->where('quantity','>',0);
        }
        return $query;
    })
    ->when(request('sort_by_price'),function($query){
        $query->orderBy('price',request('sort_by_price'));
    })
    ->when(request('status_id'),function($query){
        $query->whereIn('status_id',is_array(request('status_id')) ? request('status_id') : [] );
    });
    $products = $product->get();
    $brands = Brand::all();
    $categories = Category::all();
    return view('product',compact('brands','categories','products'));
});