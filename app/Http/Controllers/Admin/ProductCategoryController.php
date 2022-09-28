<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use \Gumlet\ImageResize;

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
			$path = $request->file('main_img')->store('product-categories-img', 'public');
			$data['main_img'] = '/storage/' . $path;

            $resized_url = public_path('/storage/'.str_replace('product-categories-img', 'product-categories-img-small', $path));

            $image = new ImageResize($request->file('main_img'));
            $image->resizeToShortSide(500);
            $image->save($resized_url);


            $resized_url = public_path('/storage/'.str_replace('product-categories-img', 'product-categories-img-medium', $path));

            $image = new ImageResize($request->file('main_img'));
            $image->resizeToShortSide(1000);
            $image->save($resized_url);
		}else{
			$data['main_img'] = '/images/no-image.png';
		}

        if ($request->hasfile('logo')) {
			$path = $request->file('logo')->store('product-categories-logo', 'public');
			$data['logo'] = '/storage/' . $path;


            $resized_url = public_path('/storage/'.str_replace('product-categories-logo', 'product-categories-logo-small', $path));

            $image = new ImageResize($request->file('logo'));
            $image->resizeToShortSide(500);
            $image->save($resized_url);


            $resized_url = public_path('/storage/'.str_replace('product-categories-logo', 'product-categories-logo-medium', $path));

            $image = new ImageResize($request->file('logo'));
            $image->resizeToShortSide(1000);
            $image->save($resized_url);
		}else{
			$data['logo'] = '/images/no-image.png';
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
			$path = $request->file('main_img')->store('product-categories-img', 'public');
			$data['main_img'] = '/storage/' . $path;

            $resized_url = public_path('/storage/'.str_replace('product-categories-img', 'product-categories-img-small', $path));

            $image = new ImageResize($request->file('main_img'));
            $image->resizeToShortSide(500);
            $image->save($resized_url);

            $resized_url = public_path('/storage/'.str_replace('product-categories-img', 'product-categories-img-medium', $path));

            $image = new ImageResize($request->file('main_img'));
            $image->resizeToShortSide(1000);
            $image->save($resized_url);

	        $path = public_path($product_category->main_img);
	        if (file_exists($path) && strpos($path, '/images/') === false) {
	            unlink($path);
	        }
            $small_path = str_replace('product-categories-img', 'product-categories-img-small', $path);
            if (file_exists($small_path) && strpos($small_path, '/images/') === false) {
                unlink($small_path);
            }
            $medium_path = str_replace('product-categories-img', 'product-categories-img-medium', $path);
            if (file_exists($medium_path) && strpos($medium_path, '/images/') === false) {
                unlink($medium_path);
            }
		}

        if ($request->hasfile('logo')) {
			$path = $request->file('logo')->store('product-categories-logo', 'public');
			$data['logo'] = '/storage/' . $path;

            $resized_url = public_path('/storage/'.str_replace('product-categories-logo', 'product-categories-logo-small', $path));

            $image = new ImageResize($request->file('logo'));
            $image->resizeToShortSide(500);
            $image->save($resized_url);

            $resized_url = public_path('/storage/'.str_replace('product-categories-logo', 'product-categories-logo-medium', $path));

            $image = new ImageResize($request->file('logo'));
            $image->resizeToShortSide(1000);
            $image->save($resized_url);

	        $path = public_path($product_category->logo);
	        if (file_exists($path) && strpos($path, '/images/') === false) {
	            unlink($path);
	        }
            $small_path = str_replace('product-categories-logo', 'product-categories-logo-small', $path);
            if (file_exists($small_path) && strpos($small_path, '/images/') === false) {
                unlink($small_path);
            }
            $medium_path = str_replace('product-categories-logo', 'product-categories-logo-medium', $path);
            if (file_exists($medium_path) && strpos($medium_path, '/images/') === false) {
                unlink($medium_path);
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
        $small_path_image = str_replace('product-categories-img', 'product-categories-img-small', $path);
        if (file_exists($small_path_image) && strpos($small_path_image, '/images/') === false) {
            unlink($small_path_image);
        }
        $medium_path_image = str_replace('product-categories-img', 'product-categories-img-medium', $path);
        if (file_exists($medium_path_image) && strpos($medium_path_image, '/images/') === false) {
            unlink($medium_path_image);
        }

        $path = public_path($product_category->logo);
        if (file_exists($path) && strpos($path, '/images/') === false) {
            unlink($path);
        }
        $small_path_logo = str_replace('product-categories-logo', 'product-categories-logo-small', $path);
        if (file_exists($small_path_logo) && strpos($small_path_logo, '/images/') === false) {
            unlink($small_path_logo);
        }
        $medium_path_logo = str_replace('product-categories-logo', 'product-categories-logo-medium', $path);
        if (file_exists($medium_path_logo) && strpos($medium_path_logo, '/images/') === false) {
            unlink($medium_path_logo);
        }

		$product_category->delete();

        return redirect()->route('admin.productCategories.index');
    }
}
