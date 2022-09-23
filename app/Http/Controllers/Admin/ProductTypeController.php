<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{ProductType,ProductCategory};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductTypeController extends Controller
{
    public function index()
    {

        $product_types = ProductType::orderBy('created_at', 'desc')->get();
        return view('admin.productTypes.index',[
            'product_types' => $product_types,
        ]);
    }

    public function categoriesListToType(ProductType $product_type)
    {

        $product_categories = ProductCategory::where('product_type_id', '=', $product_type->id)->orderBy('created_at', 'desc')->get();
        return view('admin.productCategories.categories-list-to-type',[
            'product_categories' => $product_categories,
        ]);
    }

    public function create()
    {
       return view('admin.productTypes.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'description' => '',
            'main_img' => 'image',
            'logo' => 'image',
            'seo_title' => 'required',
            'seo_keywords' => 'required',
            'seo_description' => 'required',
		];


        $message =         [
            'name.required' => 'Напишіть будь ласка назву.',
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
			$path = $request->file('main_img')->store('product-type-img', 'public');
			$data['main_img'] = '/storage/' . $path;
		}else{
			$data['main_img'] = '/default/no-image.png';
		}

        if ($request->hasfile('logo')) {
			$path = $request->file('logo')->store('product-type-img', 'public');
			$data['logo'] = '/storage/' . $path;
		}else{
			$data['logo'] = '/default/no-image.png';
		}

        ProductType::create($data);

        return redirect()->route('admin.productTypes.index');
    }

    public function edit(ProductType $product_type)
    {
        return view('admin.productTypes.edit', [
            'product_type' => $product_type,
        ]);
    }

    public function update(Request $request, ProductType $product_type)
    {
        $rules = [
            'name' => 'required',
            'description' => '',
            'main_img' => 'image',
            'logo' => 'image',
            'seo_title' => 'required',
            'seo_keywords' => 'required',
            'seo_description' => 'required',
		];

        $message =         [
            'name.required' => 'Напишіть будь ласка назву.',
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
			$path = $request->file('main_img')->store('product-type-img', 'public');
			$data['main_img'] = '/storage/' . $path;

	        $path = public_path($product_type->main_img);
	        if (file_exists($path) && strpos($path, '/images/') === false) {
	            unlink($path);
	        }
		}

        if ($request->hasfile('logo')) {
			$path = $request->file('logo')->store('product-type-img', 'public');
			$data['logo'] = '/storage/' . $path;

	        $path = public_path($product_type->logo);
	        if (file_exists($path) && strpos($path, '/images/') === false) {
	            unlink($path);
	        }
		}


        $saved = $product_type->update($data);

        return redirect()->route('admin.productTypes.index');
    }

    public function delete($id)
    {
        $product_type = ProductType::findOrFail($id);

        $path = public_path($product_type->main_img);
        if (file_exists($path) && strpos($path, '/images/') === false) {
            unlink($path);
        }

        $path = public_path($product_type->logo);
        if (file_exists($path) && strpos($path, '/images/') === false) {
            unlink($path);
        }

		$product_type->delete();

        return redirect()->route('admin.productTypes.index');
    }
}
