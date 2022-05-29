<?php

use App\Models\Brand;
use App\Models\BrandCategory;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/brand-category',function(Request $request){
    $brandId = $request->brandId;
    $categoryId = $request->categoryId;
    $brand = Brand::find($brandId);
    Category::find($categoryId)->first();
    $brand->categories()->attach($categoryId);

    return 'success';

});

 Route::post('/brands',function(Request $request){
    $name = $request->name;
    $brand = new Brand;
    $brand->name = $name;
    $brand->save();
    return $brand->name;
 });

Route::post('/categories',function(Request $request){
   $name = $request->name;
   $category = new Category;
   $category->name = $name;
   $category->save();
   return $category->name;
});


Route::get('/brands/{id}/categories',function($id){
    return  Brand::where('id',$id)->with('categories')->first();
});

Route::post('/products',function(Request $request){
    $brandId = $request->brandId;
    $categoryId = $request->categoryId;
    $brandCategoryId = BrandCategory::where('brand_id',$brandId)
        ->where('category_id',$categoryId)
        ->first()
        ->id;
    $product = new Product;
    $product->name = $request->name;
    $product->price = $request->price;
    $product->brand_category_id = $brandCategoryId;
    $product->quantity = $request->quantity;
    $product->status_id = $request->statusId;
    $product->save();

    return 'success';
});


Route::get('/products',function(Request $request){
    $product = Product::with('brandCategory.category','brandCategory.brand')
    ->when(request('free_search'),function($query) {
        $query->where('name','like','%'.request('free_search').'%');
        $query->orWhereHas('brandCategory.category',function($query) {
            $query->where('name','like','%'.request('free_search').'%');
        });
        $query->orWhereHas('brandCategory.brand',function($query) {
            $query->where('name','like','%'.request('free_search').'%');
        });
    })
    ->when(request('stock'),function($query){
        if(request('stock') === 'unstock') {
           return $query->where('quantity',0);
        }
        if(request('stock') === 'stock'){
            return $query->where('quantity','',0);
        }
        return $query;
    })
    ->when(request('sort_by_price'),function($query){
        $query->orderBy('price',request('sort_by_price'));
    })
    ->when(request('status_id'),function($query){
        $query->whereIn('status_id',is_array(request('status_id')) ? request('status_id') : [] );
    })  
    ->when(request('brand_id'),function($query) {
        $query->whereHas('brandCategory',function($query){
            $query->where('brand_id',request('brand_id'));
        });
    })
    ->when(request('category_id'),function($query) {
        $query->whereHas('brandCategory',function($query){
            $query->where('category_id',request('category_id'));
        });
    });
    return $product->get();
});