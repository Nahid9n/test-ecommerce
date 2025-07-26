<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    private static $category, $image, $imageName, $directory, $imageUrl;

    private static function getImageUrl($request)
    {

        self::$image        = $request->file('image');
        self::$imageName    = rand(1,100).self::$image->getClientOriginalName();
        self::$directory    = "admin/img/category-img/";
        self::$image->move(self::$directory, self::$imageName);
        self::$imageUrl     = self::$directory.self::$imageName;
        return self::$imageUrl;
    }

    public static function newCategory($request)
    {
        self::$imageUrl = $request->file('image') ? self::getImageUrl($request) : ' ';

        self::$category = new Category();
        self::saveBasicInfo(self::$category, $request, self::$imageUrl);
    }

    public static function checkStatus($category)
    {
        self::$category= self::find($category->id);
        if (self::$category->status == 1){
            self::$category->status = 0;
        }
        else{
            self::$category->status = 1;
        }
        self::$category->save();
    }
    public static function updateCategory($request, $category)
    {
        if ($request->file('image'))
        {
            if (file_exists($category->image))
            {
                unlink($category->image);
            }
            self::$imageUrl = self::getImageUrl($request);
        }
        else
        {
            self::$imageUrl = $category->image;
        }
        self::saveBasicInfo($category, $request, self::$imageUrl);
    }

    private static function saveBasicInfo($category, $request, $imageUrl)
    {
        $category->name           = $request->name;
        $category->slug           = Str::slug($request->name);
        $category->description    = $request->description;
        $category->image          = $imageUrl;
        $category->status         = $request->status;
        $category->save();
    }




}
