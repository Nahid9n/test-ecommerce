<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Coupon;
use App\Models\CouponCollect;
use App\Models\Feature;
use App\Models\Highlight;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductHighlight;
use App\Models\ProductOffer;
use App\Models\ProductSize;
use App\Models\ProductTag;
use App\Models\Size;
use App\Models\SubCategory;
use App\Models\Tag;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Exception;
use Session;


class EvaraController extends Controller
{
    private $product, $productOffer, $discount;
    private $per_page = 12;
    public function index()
    {


      return view('website.home.index',[
          'products' => Product::orderBy('id','desc')->take(12)->get(),
          'latestProducts' => Product::where('status',1)->take(50)->latest()->get(),
          'categories' => Category::where('status',1) ->orderBy('id','desc')->get(),
      ]);
    }
    public function category($slug)
    {
        $category = Category::where('slug',$slug)->first();
        $products = Product::where('category_id',$category->id)->orderBy('id','desc')->paginate(18);
        return view('website.category.index',[
            'products' => $products,
            'categorySlug' => $slug,

            'categories' => Category::where('status',1)->latest()->get(),



        ]);
    }

    public function allProduct()
    {
        return view('website.product.allproduct', [
            'products' => Product::where('status',1)->latest()->paginate(60),
            'categories' => Category::where('status',1)->latest()->get(),

        ]);
    }


    public function productDetails($slug)
    {
        try {
            $product = Product::where('slug',$slug)->first();

            $productOffer = ProductOffer::where('product_id', $product->id)->orderBy('id', 'desc')->first();
            if ($productOffer)
            {
                $discount = $productOffer;
            }
            else
            {
                $discount = '';
            }

            return view('website.product.index', [
                'product' => $product,
                'category_products' => Product::where('category_id',$product->category_id)
                    ->orderBy('id','desc')
                    ->take(4)
                    ->get(),
                'discount'  => $discount,
            ]);
        }
        catch (Exception $exception){
            return back()->with('error',$exception->getMessage());
        }

    }

    public function filter(Request $request)
    {
        $query = Product::query();

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('min_price')) {
            $query->where('regular_price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('regular_price', '<=', $request->max_price);
        }
        $products = $query->paginate(60);
            if ($products->isEmpty()) {
                return view('website.empty.empty');
            }
            return view('website.filter.ajaxFilter', compact('products'));
    }
    public function search(Request $request)
    {
        $query = $request->input('search_text');
        $products = Product::with('category')
        ->where(function ($q) use ($query) {
            $q->where('name', 'like', "%{$query}%")
                ->orWhere('short_description', 'like', "%{$query}%");
        })->orWhereHas('category', function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })
            ->get();
        $categories = Category::where('status',1)->get();
        return view('website.filter.searchAjaxProduct', compact('products','categories'));
    }
    public function paginate(Request $request)
    {
        $products = Product::where('status',1)->paginate(20);
        return view('website.pagination.paginate', compact('products'))->render();
    }
}
