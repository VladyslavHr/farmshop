<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    public function index()
    {

        $product_categories = ProductCategory::orderBy('created_at', 'desc')->get();
        return view('admin.productCategories.index',[
            'product_categories' => $product_categories,
        ]);
    }

    public function productsListToCategory(ProductCategory $product_category)
    {
        // $product_categories = ProductCategory::orderBy('created_at', 'desc')->get();
        return view('admin.products.products-list-to-category', [
            'product_category' => $product_category,
        ]);
    }

    public function create()
    {
        $product_types = ProductType::get(['id', 'name']);
        return view('admin.productCategories.create', [
            'product_types' => $product_types,
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'product_type_id' => 'required',
            'description' => '',
            'main_img' => 'image',
            'logo' => 'image',
            'seo_title' => 'required',
            'seo_keywords' => 'required',
            'seo_description' => 'required',
		];


        $message =         [
            'name.required' => 'Напишіть будь ласка назву.',
            'product_type_id' => 'Виберіть будь ласка вид товару',
            'main_img' => 'Картинка має бути у форматі (jpg,png,webp).',
            'logo' => 'Логотип має бути у форматі (jpg,png,webp).',
            'seo_title.required' => 'Напишіть будь ласка заголовок для SEO .',
            'seo_keywords.required' => 'Напишіть будь ласка ключові слова для SEO.',
            'seo_description.required' => 'Напишіть будь ласка опис для SEO.',
        ];

        $data = $request->validate($rules, $message, );
        $data['slug'] = Str::slug($data['name']);
        $data['user_id'] = auth()->user()->id;

		if ($request->hasfile('main_img')) {
			$path = $request->file('main_img')->store('product-categorie-img', 'public');
			$data['main_img'] = '/storage/' . $path;
		}else{
			$data['main_img'] = '/default/no-image.png';
		}

        if ($request->hasfile('logo')) {
			$path = $request->file('logo')->store('product-categorie-img', 'public');
			$data['logo'] = '/storage/' . $path;
		}else{
			$data['logo'] = '/default/no-image.png';
		}

        ProductCategory::create($data);

        return redirect()->route('admin.productCategories.index');
    }

    public function edit(ProductCategory $product_category)
    {
        $product_types = ProductType::get(['id', 'name']);
        return view('admin.productCategories.edit', [
            'product_category' => $product_category,
            'product_types' => $product_types,
        ]);
    }

    public function update(Request $request, ProductCategory $product_category)
    {
        $rules = [
            'name' => 'required',
            'product_type_id' => 'required',
            'description' => '',
            'main_img' => 'image',
            'logo' => 'image',
            'seo_title' => 'required',
            'seo_keywords' => 'required',
            'seo_description' => 'required',
		];


        $message =         [
            'name.required' => 'Напишіть будь ласка назву.',
            'product_type_id' => 'Виберіть будь ласка вид товару',
            'main_img' => 'Картинка має бути у форматі (jpg,png,webp).',
            'logo' => 'Логотип має бути у форматі (jpg,png,webp).',
            'seo_title.required' => 'Напишіть будь ласка заголовок для SEO .',
            'seo_keywords.required' => 'Напишіть будь ласка ключові слова для SEO.',
            'seo_description.required' => 'Напишіть будь ласка опис для SEO.',
        ];

        $data = $request->validate($rules, $message, );
        $data['slug'] = Str::slug($data['name']);
        $data['user_id'] = auth()->user()->id;


        if ($request->hasfile('main_img')) {
			$path = $request->file('main_img')->store('product-categorie-img', 'public');
			$data['main_img'] = '/storage/' . $path;

	        $path = public_path($product_category->main_img);
	        if (file_exists($path) && strpos($path, '/images/') === false) {
	            unlink($path);
	        }
		}

        if ($request->hasfile('logo')) {
			$path = $request->file('logo')->store('product-categorie-img', 'public');
			$data['logo'] = '/storage/' . $path;

	        $path = public_path($product_category->logo);
	        if (file_exists($path) && strpos($path, '/images/') === false) {
	            unlink($path);
	        }
		}


        $saved = $product_category->update($data);

        return redirect()->route('admin.productCategories.index');
    }

    public function delete($id)
    {
        $product_category = ProductCategory::findOrFail($id);

        $path = public_path($product_category->main_img);
        if (file_exists($path) && strpos($path, '/images/') === false) {
            unlink($path);
        }

        $path = public_path($product_category->logo);
        if (file_exists($path) && strpos($path, '/images/') === false) {
            unlink($path);
        }

		$product_category->delete();

        return redirect()->route('admin.productCategories.index');
    }
}
