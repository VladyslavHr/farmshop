<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{ProductType,ProductCategory};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use \Gumlet\ImageResize;

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

            $resized_url = public_path('/storage/'.str_replace('product-type-img', 'product-type-img-small', $path));

            $image = new ImageResize($request->file('main_img'));
            $image->resizeToShortSide(500);
            $image->save($resized_url);


            $resized_url = public_path('/storage/'.str_replace('product-type-img', 'product-type-img-medium', $path));

            $image = new ImageResize($request->file('main_img'));
            $image->resizeToShortSide(1000);
            $image->save($resized_url);
		}else{
			$data['main_img'] = '/images/no-image.png';
		}

        if ($request->hasfile('logo')) {
			$path = $request->file('logo')->store('product-type-logo', 'public');
			$data['logo'] = '/storage/' . $path;

            $resized_url = public_path('/storage/'.str_replace('product-type-logo', 'product-type-logo-small', $path));

            $image = new ImageResize($request->file('logo'));
            $image->resizeToShortSide(500);
            $image->save($resized_url);


            $resized_url = public_path('/storage/'.str_replace('product-type-logo', 'product-type-logo-medium', $path));

            $image = new ImageResize($request->file('logo'));
            $image->resizeToShortSide(1000);
            $image->save($resized_url);
		}else{
			$data['logo'] = '/images/no-image.png';
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

            $resized_url = public_path('/storage/'.str_replace('product-type-img', 'product-type-img-small', $path));

            $image = new ImageResize($request->file('main_img'));
            $image->resizeToShortSide(500);
            $image->save($resized_url);

            $resized_url = public_path('/storage/'.str_replace('product-type-img', 'product-type-img-medium', $path));

            $image = new ImageResize($request->file('main_img'));
            $image->resizeToShortSide(1000);
            $image->save($resized_url);

	        $path = public_path($product_type->main_img);
	        if (file_exists($path) && strpos($path, '/images/') === false) {
	            unlink($path);
	        }
            $small_path = str_replace('product-type-img', 'product-type-img-small', $path);
            if (file_exists($small_path) && strpos($small_path, '/images/') === false) {
                unlink($small_path);
            }
            $medium_path = str_replace('product-type-img', 'product-type-img-medium', $path);
            if (file_exists($medium_path) && strpos($medium_path, '/images/') === false) {
                unlink($medium_path);
            }
		}

        if ($request->hasfile('logo')) {
			$path = $request->file('logo')->store('product-type-logo', 'public');
			$data['logo'] = '/storage/' . $path;

            $resized_url = public_path('/storage/'.str_replace('product-type-logo', 'product-type-logo-small', $path));

            $image = new ImageResize($request->file('logo'));
            $image->resizeToShortSide(500);
            $image->save($resized_url);

            $resized_url = public_path('/storage/'.str_replace('product-type-logo', 'product-type-logo-medium', $path));

            $image = new ImageResize($request->file('logo'));
            $image->resizeToShortSide(1000);
            $image->save($resized_url);

	        $path = public_path($product_type->logo);
	        if (file_exists($path) && strpos($path, '/images/') === false) {
	            unlink($path);
	        }
            $small_path = str_replace('product-type-logo', 'product-type-logo-small', $path);
            if (file_exists($small_path) && strpos($small_path, '/images/') === false) {
                unlink($small_path);
            }
            $medium_path = str_replace('product-type-logo', 'product-type-logo-medium', $path);
            if (file_exists($medium_path) && strpos($medium_path, '/images/') === false) {
                unlink($medium_path);
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
        $small_path_image = str_replace('product-type-img', 'product-type-img-small', $path);
        if (file_exists($small_path_image) && strpos($small_path_image, '/images/') === false) {
            unlink($small_path_image);
        }
        $medium_path_medium = str_replace('product-type-img', 'product-type-img-medium', $path);
        if (file_exists($medium_path_medium) && strpos($medium_path_medium, '/images/') === false) {
            unlink($medium_path_medium);
        }

        $path = public_path($product_type->logo);
        if (file_exists($path) && strpos($path, '/images/') === false) {
            unlink($path);
        }
        $small_path_logo = str_replace('product-type-logo', 'product-type-logo-small', $path);
        if (file_exists($small_path_logo) && strpos($small_path_logo, '/images/') === false) {
            unlink($small_path_logo);
        }
        $medium_path_logo = str_replace('product-type-logo', 'product-type-logo-medium', $path);
        if (file_exists($medium_path_logo) && strpos($medium_path_logo, '/images/') === false) {
            unlink($medium_path_logo);
        }

		$product_type->delete();

        return redirect()->route('admin.productTypes.index');
    }
}
