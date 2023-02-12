<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\{Product, ProductType};

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sitemap()
    {
        $content =  '<?xml version="1.0" encoding="UTF-8"?>
        <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';


        $products = Product::get(['slug', 'updated_at']);

        foreach ($products as $product){
            $content .= '<url>
            <loc>'. route('products.show', $product->slug) .'</loc>
            <lastmod>'. $product->updated_at->format('Y-m-d') .'</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.5</priority>
          </url>';
        }

        $productTypes = ProductType::get(['slug', 'updated_at']);

        foreach ($productTypes as $productType){
            $content .= '<url>
            <loc>'. route('productTypes.show', $productType->slug) .'</loc>
            <lastmod>'. $productType->updated_at->format('Y-m-d') .'</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.5</priority>
          </url>';
        }

        $content .= '<url>
        <loc>'. route('home.index') .'</loc>
        <lastmod>'. date('Y-m-d') .'</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
        </url>';

        $content .= '<url>
        <loc>'. route('products.index') .'</loc>
        <lastmod>'. date('Y-m-d') .'</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.5</priority>
        </url>';

        $content .= '<url>
        <loc>'. route('contacts.index') .'</loc>
        <lastmod>'. date('Y-m-d') .'</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.5</priority>
        </url>';


        // route('stranky.show', 'poznejte-kanarske-ostrovy-na-maximum')

        $content .= '</urlset>';

        return response($content)->header('Content-Type', 'text/xml');
    }
}
