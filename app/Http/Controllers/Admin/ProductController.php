<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Product,ProductCategory,Note};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
            'seo_title' => 'required',
            'seo_keywords' => 'required',
            'seo_description' => 'required',
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

        $data = $request->validate($rules, $message, );
        $data['slug'] = Str::slug($data['name']);
        $data['user_id'] = auth()->user()->id;

		if ($request->hasfile('main_img')) {
			$path = $request->file('main_img')->store('product-img', 'public');
			$data['main_img'] = '/storage/' . $path;
		}else{
			$data['main_img'] = '/default/no-image.png';
		}

        if ($request->hasfile('logo')) {
			$path = $request->file('logo')->store('product-img', 'public');
			$data['logo'] = '/storage/' . $path;
		}else{
			$data['logo'] = '/default/no-image.png';
		}

        Product::create($data);

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
            'price' => '',
            'old_price' => '',
            'price_type' => '',
            'quantity' => '',
            'main_img' => 'image',
            'logo' => 'image',
            'status' => '',
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
			$path = $request->file('main_img')->store('product-img', 'public');
			$data['main_img'] = '/storage/' . $path;

	        $path = public_path($product->main_img);
	        if (file_exists($path) && strpos($path, '/images/') === false) {
	            unlink($path);
	        }
		}

        if ($request->hasfile('logo')) {
			$path = $request->file('logo')->store('product-img', 'public');
			$data['logo'] = '/storage/' . $path;

	        $path = public_path($product->logo);
	        if (file_exists($path) && strpos($path, '/images/') === false) {
	            unlink($path);
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

        $path = public_path($product->logo);
        if (file_exists($path) && strpos($path, '/images/') === false) {
            unlink($path);
        }

		$product->delete();

        return redirect()->route('admin.products.index');
    }
}
