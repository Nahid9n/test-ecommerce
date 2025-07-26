<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    private static $product,$slug, $image,$backImage,$imageName,$extension, $directory,$imageUrl,$backImageName,$backImageUrl;


    private static function getImageUrl($request)
    {
        self::$image = $request->file('image');
        self::$imageName = self::$image->getClientOriginalName();
        self::$directory = "admin/img/product-img/";
        self::$image->move(self::$directory, self::$imageName);
        return self::$directory . self::$imageName;
    }
    private static function getBackImageUrl($request)
    {
        self::$backImage = $request->file('back_image');
        self::$backImageName = self::$backImage->getClientOriginalName();
        self::$directory = "admin/img/product-img/";
        self::$backImage->move(self::$directory, self::$backImageName);
        return self::$directory . self::$backImageName;
    }

    public static function newProduct($request)
    {
        self::$product = new Product();

        self::$product->category_id = $request->category_id;
    
        self::$product->name = $request->name;
//        slug
        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $counter = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
//end slug
        self::$product->slug  = $slug;
        self::$product->code = $request->code;
        self::$product->short_description = $request->short_description;
        self::$product->long_description = $request->long_description;
        self::$product->stock_amount = $request->stock_amount;
        if ($request->image) {
            self::$product->image = self::getImageUrl($request);
        }
        if ($request->back_image) {
            self::$product->back_image = self::getBackImageUrl($request);
        }
       
        self::$product->regular_price = $request->regular_price;
        self::$product->selling_price = $request->selling_price;

        self::$product->mrp = $request->mrp;
        
        if ($request->status)
        {
            self::$product->status = $request->status;
        }
        else
        {
            self::$product->status = 0;
        }

        self::$product->vendor_id = auth()->user()->id;
        self::$product->save();
        return self::$product;
    }
    public static function updateProduct( $request, $product )
    {
        $product->category_id = $request->category_id;
        
        if ($product->name == $request->name){
            $product->slug  = $product->slug;
        }
        else{
            $slug = Str::slug($request->name);
            $originalSlug = $slug;
            $counter = 1;
            while (Product::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }
            $product->slug  = $slug;
        }
        $product->name = $request->name;
        $product->code = $request->code;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
//        $product->long_description = strip_tags($request->long_description);

        if ($request->file('image')) {
            if (file_exists($product->image)) {
                unlink($product->image);
            }
            $product->image = self::getImageUrl($request);
        }
        if ($request->file('back_image')) {
            if (file_exists($product->back_image)) {
                unlink($product->back_image);
            }
            $product->back_image = self::getBackImageUrl($request);;
        }
    
        $product->regular_price = $request->regular_price;
        $product->selling_price = $request->selling_price;
        
        $product->stock_amount = $request->stock_amount;
        
        $product->mrp = $request->mrp;
    
        if ($request->status)
        {
            $product->status = $request->status;
        }
        $product->save();
    }
    public static  function deleteProduct($product){

        if (file_exists($product->image)) {
            unlink($product->image);
        }
        if (file_exists($product->back_image)) {
            unlink($product->back_image);
        }
        $product->delete();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }
}
