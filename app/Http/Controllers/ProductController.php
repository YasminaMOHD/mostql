<?php

namespace App\Http\Controllers;

use App\Store;
use Throwable;
use App\Product;
use App\Category;
use Carbon\Carbon;
use App\StoreProduct;
use App\CategoryDescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Date;
use Facade\FlareClient\Http\Response;
use Illuminate\Database\Eloquent\Builder;

class ProductController extends Controller
{

    public function index()
    {

        $category=[];
        $category1=[];
        $id_session=[];
        $store_session=[];
        session()->put('lang_cat', 1);
        session()->put('language', 1);
        $categories = Category::with('description')->where('parent_id',0)->get();
        if($categories != null){
            foreach($categories as $cat){
                $subCategory=Category::with('description')->where('parent_id',$cat->category_id)->get();
                $category[$cat->description->name]=$subCategory;
            }
             if($category != null){
                foreach($category as $name=>$cat){
                    foreach($cat as $c){
                        $subCategory1=Category::with('description')->where('parent_id',$c->category_id)->get();
                        $category1[$name." > ".$c->description->name]=$subCategory1;
                        foreach($subCategory1 as $id){
                            array_push($id_session,$id->category_id);
                        }
                    }
                }
            }
        }
        $stores = Store::get();
        foreach($stores as $s){
           array_push($store_session,$s->id);
        }
        $maxPrice = Product::orderBy('price', 'DESC')->first()->price;
        session()->put('category', $id_session);
        session()->put('store', $store_session);
        $products = Product::with('categories', 'stores', 'description', 'manufacturer')
        ->whereHas('categories', function($q) {
            if(session('category') != null){
              $q->whereIn('oc_product_to_category.category_id',session('category') );
            }
         })
         ->with('storeProduct')->get();

        return view('index', [
            'products' => $products,
            'categories' => $category1,
            'stores' => $stores,
            'maxPrice' => $maxPrice,
        ]);
    }

    public function categoryLanguage(Request $request){
        $lang=$request->lang;
        $category=[];
        $category1=[];
        $id_session=[];
        session()->put('lang_cat', $lang);
        $categories = Category::with('description')->where('parent_id',0)->get();
        if($categories != null){
            foreach($categories as $cat){
                $subCategory=Category::with('description')->where('parent_id',$cat->category_id)->get();
                $category[$cat->description->name]=$subCategory;
            }
             if($category != null){
                foreach($category as $name=>$cat){
                    foreach($cat as $c){
                        $subCategory1=Category::with('description')->where('parent_id',$c->category_id)->get();
                        $category1[$name." > ".$c->description->name]=$subCategory1;
                        foreach($subCategory1 as $id){
                            array_push($id_session,$id->category_id);
                        }
                    }
                }
            }
        }
        session()->put('category', $id_session);
        return json_encode($category1);
    }

    public function search(Request $request)
    {
       $category=$request->category;
       $store=$request->store;
       $fromPrice=$request->fromPrice;
       $toPrice=$request->toPrice;
       $count=$request->count;
       $fromDate=$request->fromDate;
       $toDate=$request->toDate;
       if($category == ['all']){
           $category= session('category');
       }
       if($store == ['all']){
           $store= session('store');
       }
       $request->session()->put('sub2Category', $category);
       $request->session()->put('store', $store);
       $request->session()->put('language', $request->lang);

       try {
        $products =Product::with('description','categories','stores','storeProduct')
        ->whereHas('storeProduct',function($q){
         if(session('store') != null){
             $q->whereIn('oc_purpletree_vendor_stores.id',session('store'));
         }
     })
        ->whereHas('categories', function($q) {
            if(session('sub2Category') != null){
              $q->whereIn('oc_product_to_category.category_id',session('sub2Category') );
            }
         })
         ;
         if($toPrice != 0 && $fromPrice !=0){
             $products->whereBetween('price',[$fromPrice,$toPrice]);
         }
         if($toDate != null && $fromDate !=null){
             $products->whereBetween('date_available',[$fromDate,$toDate]);
         }else{
             if($toDate == null && $fromDate !=null){
                 $products->whereBetween('date_available',[$fromDate,Carbon::now()->format('Y-m-d')]);
             }
         }
         if($count != null ){
            return $products->get()->random($count);

         }


         return $products->inRandomOrder()->get();

    } catch (Throwable $e) {

        return [];
    }



    }



}
