<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\AboutUs;
use App\Models\Category;
use App\Models\ContactUs;
use App\Models\Permission;
use App\Models\PrivacyPolicy;
use App\Models\PurchaseGuide;
use App\Models\ReturnPolicy;
use App\Models\ShippingPolicy;
use App\Models\TermsCondition;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Route;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(WebsiteSetting::class);
        // Database Seeder --------------------------------------------------------------------
        $routeCollection = Route::getRoutes();
        $middlewareGroup = 'admin.auth';
        $routeNames = [];
        foreach ($routeCollection as $route){
            $middleWares = $route->gatherMiddleware();
            if (in_array($middlewareGroup,$middleWares)){
                $routeName = $route->getName();
                if ($routeName !== 'admin.dashboard' && $routeName !== 'admin.logout'){
                    array_push($routeNames,$routeName);
                }
            }
        }






    }
}
