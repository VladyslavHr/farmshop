<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Product,ProductCategory,Note,ProductGallery};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use \Gumlet\ImageResize;

class ProductController extends Controller
{
    public function index()
    {

        $products = Product::orderBy('created_at', 'desc')->get();
        return view('admin.products.index',[
            'products' => $products,
        ]);
    }

    public function create()
    {
        $product_categories = ProductCategory::get(['id', 'name']);
        return view('admin.products.create', [
            'product_categories' => $product_categories,
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'product_category_id' => 'required',
            'description' => '',
            'price' => '',
            'old_price' => '',
            'price_type' => '',
            'quantity' => '',
            'main_img' => 'image',
            'logo' => 'image',
            'status' => '',
            'seo_title' => '',
            'seo_keywords' => '',
            'seo_description' => '',
		];

        $message =         [
            'name.required' => 'Напишіть будь ласка назву.',
            'product_category_id' => 'Виберіть будь ласка категорію товару',
            'price' => 'Напишіть будь ласка ціну товару',
            'price_type' => 'Напишіть будь ласка вид ціни',
            'main_img' => 'Картинка має бути у форматі (jpg,png,webp).',
            'logo' => 'Логотип має бути у форматі (jpg,png,webp).',
            'seo_title.required' => 'Напишіть будь ласка заголовок для SEO .',
            'seo_keywords.required' => 'Напишіть будь ласка ключові слова для SEO.',
            'seo_description.required' => 'Напишіть будь ласка опис для SEO.',
        ];

        $data = $request->validate($rules, $message);
        $data['slug'] = Str::slug($data['name']);
        $data['user_id'] = auth()->user()->id;

		if ($request->hasfile('main_img')) {
			$path = $request->file('main_img')->store('product-img', 'public');
			$data['main_img'] = '/storage/' . $path;

            $resized_url = public_path('/storage/'.str_replace('product-img', 'product-img-small', $path));

            $image = new ImageResize($request->file('main_img'));
            $image->resizeToShortSide(500);
            $image->save($resized_url);


            $resized_url = public_path('/storage/'.str_replace('product-img', 'product-img-medium', $path));

            $image = new ImageResize($request->file('main_img'));
            $image->resizeToShortSide(1000);
            $image->save($resized_url);
		}else{
			$data['main_img'] = '/images/no-thumb-r.jpg';
		}

        $product = Product::create($data);

        if($request->hasfile('gallery'))
        {
            if(count($request->file('gallery')) > 10){
                return redirect()->back()->withErrors('Максимум 10 зображення!')->withInput($request->all());
            }
            foreach($request->file('gallery') as $key => $file)
            {
                $path = $file->store('product-gallery', 'public');
                $product_image = new ProductGallery();
                $product_image->product_id = $product->id;
                // $product_image->product_id = $request->get('product_id');
                $product_image->image = '/storage/'.$path;
                $product_image->save();

                $resized_url = public_path('/storage/'.str_replace('product-gallery', 'product-gallery-small', $path));

                $image = new ImageResize($file);
                $image->resizeToShortSide(500);
                $image->save($resized_url);

                $resized_url = public_path('/storage/'.str_replace('product-gallery', 'product-gallery-medium', $path));

                $image = new ImageResize($file);
                $image->resizeToShortSide(1000);
                $image->save($resized_url);

            }
        }

        return redirect()->route('admin.products.index');
    }

    public function show(Product $product)
    {
        // $product = Product::with('notes.author:id,name,last_name')->findOrFail($product);
        $product_notes = Note::where('id', $product)->orderBy('created_at', 'desc')->get();
        return view('admin.products.show', [
            'product' => $product,
            'product_notes' => $product_notes,
            // 'note' => $product->note,
        ]);
    }


    public function edit(Product $product)
    {
        $product_categories = ProductCategory::get(['id', 'name']);
        return view('admin.products.edit', [
            'product' => $product,
            'product_categories' => $product_categories,
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $rules = [
            'name' => 'required',
            'product_category_id' => 'required',
            'description' => '',
            'price' => 'required',
            'old_price' => '',
            'price_type' => '',
            'quantity' => 'required',
            'main_img' => 'image',
            'logo' => 'image',
            'status' => '',
            'seo_title' => '',
            'seo_keywords' => '',
            'seo_description' => '',
		];

        $message =         [
            'name.required' => 'Напишіть будь ласка назву.',
            'product_type_id' => 'Виберіть будь ласка вид товару',
            'main_img' => 'Картинка має бути у форматі (jpg,png,webp).',
            'logo' => 'Логотип має бути у форматі (jpg,png,webp).',
            'price.required' => 'Напишіть будь ласка ціну .',
            'quantity.required' => 'Напишіть будь ласка кількість .',
            'seo_title.required' => 'Напишіть будь ласка заголовок для SEO .',
            'seo_keywords.required' => 'Напишіть будь ласка ключові слова для SEO.',
            'seo_description.required' => 'Напишіть будь ласка опис для SEO.',
        ];

        $data = $request->validate($rules, $message, );
        $data['slug'] = Str::slug($data['name']);
        $data['user_id'] = auth()->user()->id;


        if ($request->hasfile('main_img')) {
			$path = $request->file('main_img')->store('product-img', 'public');
			$data['main_img'] = '/storage/' . $path;

            $resized_url = public_path('/storage/'.str_replace('product-img', 'product-img-small', $path));

            $image = new ImageResize($request->file('main_img'));
            $image->resizeToShortSide(500);
            $image->save($resized_url);


            $resized_url = public_path('/storage/'.str_replace('product-img', 'product-img-medium', $path));

            $image = new ImageResize($request->file('main_img'));
            $image->resizeToShortSide(1000);
            $image->save($resized_url);

	        $path = public_path($product->main_img);
	        if (file_exists($path) && strpos($path, '/images/') === false) {
	            unlink($path);
	        }
            $small_path = str_replace('product-img', 'product-img-small', $path);
            if (file_exists($small_path) && strpos($small_path, '/images/') === false) {
                unlink($small_path);
            }
            $medium_path = str_replace('product-img', 'product-img-medium', $path);
            if (file_exists($medium_path) && strpos($medium_path, '/images/') === false) {
                unlink($medium_path);
            }
		}

        if($request->hasfile('gallery'))
        {
            if(count($request->file('gallery')) > 10){
                return redirect()->back()->withErrors('Максимум 10 зображення!')->withInput($request->all());
            }
            foreach($request->file('gallery') as $key => $file)
            {
                $path = $file->store('product-gallery', 'public');
                $product_image = new ProductGallery();
                $product_image->product_id = $product->id;
                // $product_image->product_id = $request->get('product_id');
                $product_image->image = '/storage/'.$path;
                $product_image->save();

                $resized_url = public_path('/storage/'.str_replace('product-gallery', 'product-gallery-small', $path));

                $image = new ImageResize($file);
                $image->resizeToShortSide(500);
                $image->save($resized_url);

                $resized_url = public_path('/storage/'.str_replace('product-gallery', 'product-gallery-medium', $path));

                $image = new ImageResize($file);
                $image->resizeToShortSide(1000);
                $image->save($resized_url);

                foreach ($product->gallery as $gallery) {
                    $path = public_path($gallery->image);
                    if (file_exists($path) && strpos($path, '/images/') === false) {
                        unlink($path);
                    }
                    $small_path_image = str_replace('product-gallery', 'product-gallery-small', $path);
                    if (file_exists($small_path_image) && strpos($small_path_image, '/images/') === false) {
                        unlink($small_path_image);
                    }
                    $medium_path_medium = str_replace('product-gallery', 'product-gallery-medium', $path);
                    if (file_exists($medium_path_medium) && strpos($medium_path_medium, '/images/') === false) {
                        unlink($medium_path_medium);
                    }
                    // $gallery->delete();
                }
            }
        }


        $saved = $product->update($data);

        return redirect()->route('admin.products.index');
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);

        $path = public_path($product->main_img);
        if (file_exists($path) && strpos($path, '/images/') === false) {
            unlink($path);
        }
        $small_path_image = str_replace('product-img', 'product-img-small', $path);
        if (file_exists($small_path_image) && strpos($small_path_image, '/images/') === false) {
            unlink($small_path_image);
        }
        $medium_path_medium = str_replace('product-img', 'product-img-medium', $path);
        if (file_exists($medium_path_medium) && strpos($medium_path_medium, '/images/') === false) {
            unlink($medium_path_medium);
        }


        foreach ($product->gallery as $gallery) {
	        $path = public_path($gallery->image);
	        if (file_exists($path) && strpos($path, '/images/') === false) {
	            unlink($path);
	        }
            $small_path_image = str_replace('product-gallery', 'product-gallery-small', $path);
            if (file_exists($small_path_image) && strpos($small_path_image, '/images/') === false) {
                unlink($small_path_image);
            }
            $medium_path_medium = str_replace('product-gallery', 'product-gallery-medium', $path);
            if (file_exists($medium_path_medium) && strpos($medium_path_medium, '/images/') === false) {
                unlink($medium_path_medium);
            }
	        $gallery->delete();
        }


		$product->delete();

        return redirect()->route('admin.products.index');
    }


    public function productImageDelete(ProductGallery $gallery)
	{

        $path = public_path($gallery->image);
        if (file_exists($path) && strpos($path, '/images/') === false) {
            unlink($path);
        }
        $small_path_image = str_replace('product-gallery', 'product-gallery-small', $path);
        if (file_exists($small_path_image) && strpos($small_path_image, '/images/') === false) {
            unlink($small_path_image);
        }
        $medium_path_medium = str_replace('product-gallery', 'product-gallery-medium', $path);
        if (file_exists($medium_path_medium) && strpos($medium_path_medium, '/images/') === false) {
            unlink($medium_path_medium);
        }
		$gallery->delete();
		return [
            'status' => 'ok',
        ];
	}

}
