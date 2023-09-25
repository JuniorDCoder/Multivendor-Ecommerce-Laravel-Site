<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Adverisement;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\HomePageSetting;
use App\Models\Product;
use App\Models\Slider;
use App\Models\SubCategory;
use App\Models\Vendor;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', 1)->orderBy('serial', 'asc')->get();
        $flashSaleDate = FlashSale::first();
        $flashSaleItems = FlashSaleItem::where('show_at_home', 1)->where('status', 1)->get();
        $popularCategory = HomePageSetting::where('key', 'popular_category_section')->first();
        $brands = Brand::where('status', 1)->where('is_featured', 1)->get();

        $typeBaseProducts = $this->getTypeBaseProduct();
        $categoryProductSliderSectionOne = HomePageSetting::where('key', 'product_slider_section_one')->first();
        $categoryProductSliderSectionTwo = HomePageSetting::where('key', 'product_slider_section_two')->first();
        $categoryProductSliderSectionThree = HomePageSetting::where('key', 'product_slider_section_three')->first();

        // banners

        $homepage_secion_banner_one = Adverisement::where('key', 'homepage_secion_banner_one')->first();
        $homepage_secion_banner_one = json_decode($homepage_secion_banner_one->value);

        $homepage_secion_banner_two = Adverisement::where('key', 'homepage_secion_banner_two')->first();
        $homepage_secion_banner_two = json_decode($homepage_secion_banner_two?->value);

        $homepage_secion_banner_three = Adverisement::where('key', 'homepage_secion_banner_three')->first();
        $homepage_secion_banner_three = json_decode($homepage_secion_banner_three?->value);

        $homepage_secion_banner_four = Adverisement::where('key', 'homepage_secion_banner_four')->first();
        $homepage_secion_banner_four = json_decode($homepage_secion_banner_four?->value);

        $recentBlogs = Blog::with(['category', 'user'])->where('status',1)->orderBy('id', 'DESC')->take(8)->get();

        return view('frontend.home.home',
            compact(
                'sliders',
                'flashSaleDate',
                'flashSaleItems',
                'popularCategory',
                'brands',
                'typeBaseProducts',
                'categoryProductSliderSectionOne',
                'categoryProductSliderSectionTwo',
                'categoryProductSliderSectionThree',

                'homepage_secion_banner_one',
                'homepage_secion_banner_two',
                'homepage_secion_banner_three',
                'homepage_secion_banner_four',
                'recentBlogs'

            ));
    }

    public function getTypeBaseProduct()
    {
        $typeBaseProducts = [];

        $typeBaseProducts['new_arrival'] = Product::where(['product_type' => 'new_arrival', 'is_approved' => 1, 'status' => 1])->orderBy('id', 'DESC')->take(8)->get();
        $typeBaseProducts['featured_product'] = Product::where(['product_type' => 'featured_product', 'is_approved' => 1, 'status' => 1])->orderBy('id', 'DESC')->take(8)->get();
        $typeBaseProducts['top_product'] = Product::where(['product_type' => 'top_product', 'is_approved' => 1, 'status' => 1])->orderBy('id', 'DESC')->take(8)->get();
        $typeBaseProducts['best_product'] = Product::where(['product_type' => 'best_product', 'is_approved' => 1, 'status' => 1])->orderBy('id', 'DESC')->take(8)->get();

        return $typeBaseProducts;
    }

    public function vendorPage()
    {
       $vendors = Vendor::where('status',1)->paginate(20);
       return view('frontend.pages.vendor', compact('vendors'));
    }

    public function vendorProductsPage(string $id)
    {

        $products = Product::where(['status' => 1, 'is_approved' => 1, 'vendor_id' => $id])->orderBy('id', 'DESC')->paginate(12);

        $categories = Category::where(['status' => 1])->get();
        $brands = Brand::where(['status' => 1])->get();
        $vendor = Vendor::findOrFail($id);

        return view('frontend.pages.vendor-product', compact('products', 'categories', 'brands', 'vendor'));

    }
}
