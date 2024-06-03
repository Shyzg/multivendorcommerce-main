<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductsImage;
use App\Models\ProductsAttribute;
use App\Models\Section;

class ProductsController extends Controller
{
    // Menampilkan halaman coupon di dashboard admin pada views admin/products/products.blade.php
    public function products()
    {
        // Menggunakan session untuk sebagai penanda halaman yang sedang digunakan pada sidebar
        Session::put('page', 'products');

        $adminType = Auth::guard('admin')->user()->type;
        $vendor_id = Auth::guard('admin')->user()->vendor_id;
        $products = Product::with([
            'section' => function ($query) {
                $query->select('id', 'name');
            },
            'category' => function ($query) {
                $query->select('id', 'category_name');
            }
        ]);

        if ($adminType == 'vendor') {
            $produtcs = $products->where('vendor_id', $vendor_id);
        }

        $products = $products->get();

        return view('admin.products.products')->with(compact('products'));
    }

    public function addEditProduct(Request $request, $id = null)
    {
        Session::put('page', 'products');

        if ($id == '') {
            $title = 'Tambah Produk';
            $product = new Product();
            $message = 'Berhasil menambahkan produk';
        } else {
            $title = 'Ubah Produk';
            $product = Product::find($id);
            $message = 'Berhasil memperbarui produk';
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'category_id'   => 'required',
                'product_name'  => 'required',
                'product_price' => 'required|numeric'
            ];
            $customMessages = [
                'category_id.required'   => 'Category is required',
                'product_name.required'  => 'Nama produk harus diisi',
                'product_price.required' => 'Harga produk harus diisi',
                'product_price.numeric'  => 'Harga produk harus diisikan dengan angka'
            ];

            $this->validate($request, $rules, $customMessages);

            if ($request->hasFile('product_image')) {
                $image_tmp = $request->file('product_image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $largeImagePath  = 'front/images/product_images/large/'  . $imageName;
                    $mediumImagePath = 'front/images/product_images/medium/' . $imageName;
                    $smallImagePath  = 'front/images/product_images/small/'  . $imageName;

                    Image::make($image_tmp)->resize(1000, 1000)->save($largeImagePath);
                    Image::make($image_tmp)->resize(500,   500)->save($mediumImagePath);
                    Image::make($image_tmp)->resize(250,   250)->save($smallImagePath);

                    $product->product_image = $imageName;
                }
            }

            $categoryDetails = Category::find($data['category_id']);
            $product->section_id  = $categoryDetails['section_id'];
            $product->category_id = $data['category_id'];

            if ($id == '') {
                $adminType = Auth::guard('admin')->user()->type;
                $vendor_id = Auth::guard('admin')->user()->vendor_id;
                $admin_id  = Auth::guard('admin')->user()->id;
                $product->admin_type = $adminType;
                $product->admin_id   = $admin_id;

                if ($adminType == 'vendor') {
                    $product->vendor_id  = $vendor_id;
                } else {
                    $product->vendor_id = 0;
                }
            }
            if (empty($data['product_discount'])) {
                $data['product_discount'] = 0;
            }
            if (empty($data['product_weight'])) {
                $data['product_weight'] = 0;
            }
            $product->product_name     = $data['product_name'];
            $product->product_price    = $data['product_price'];
            $product->product_discount = $data['product_discount'];
            $product->product_weight   = $data['product_weight'];
            $product->description      = $data['description'];
            if (!empty($data['is_bestseller'])) {
                $product->is_bestseller = $data['is_bestseller'];
            } else {
                $product->is_bestseller = 'No';
            }
            $product->save();

            return redirect('admin/products')->with('success_message', $message);
        }

        $categories = Section::with('categories')->get();

        return view('admin.products.add_edit_product')->with(compact('title', 'product', 'categories'));
    }

    public function deleteProduct($id)
    {
        Product::where('id', $id)->delete();

        $message = 'Berhasil menghapus produk';

        return redirect()->back()->with('success_message', $message);
    }

    public function deleteProductImage($id)
    {
        $productImage = Product::select('product_image')->where('id', $id)->first();
        $small_image_path  = 'front/images/product_images/small/';
        $medium_image_path = 'front/images/product_images/medium/';
        $large_image_path  = 'front/images/product_images/large/';

        if (file_exists($small_image_path . $productImage->product_image)) {
            unlink($small_image_path . $productImage->product_image);
        }

        if (file_exists($medium_image_path . $productImage->product_image)) {
            unlink($medium_image_path . $productImage->product_image);
        }

        if (file_exists($large_image_path . $productImage->product_image)) {
            unlink($large_image_path . $productImage->product_image);
        }

        Product::where('id', $id)->update(['product_image' => '']);

        $message = 'Berhasil menghapus foto produk';

        return redirect()->back()->with('success_message', $message);
    }

    public function addAttributes(Request $request, $id)
    {
        Session::put('page', 'products');

        $product = Product::select('id', 'product_name', 'product_price', 'product_image')->with('attributes')->find($id);

        if ($request->isMethod('post')) {
            $data = $request->all();
            foreach ($data['sku'] as $key => $value) {
                if (!empty($value)) {
                    $skuCount = ProductsAttribute::where('sku', $value)->count();

                    if ($skuCount > 0) {
                        return redirect()->back()->with('error_message', 'SKU already exists! Please add another SKU!');
                    }

                    $attribute = new ProductsAttribute;
                    $attribute->product_id = $id;
                    $attribute->sku        = $value;
                    $attribute->stock      = $data['stock'][$key];
                    $attribute->save();
                }
            }

            return redirect()->back()->with('success_message', 'Product Attributes have been addded successfully!');
        }

        return view('admin.attributes.add_edit_attributes')->with(compact('product'));
    }

    public function editAttributes(Request $request)
    {
        Session::put('page', 'products');

        if ($request->isMethod('post')) {
            $data = $request->all();

            foreach ($data['attributeId'] as $key => $attribute) {
                if (!empty($attribute)) {
                    ProductsAttribute::where([
                        'id' => $data['attributeId'][$key]
                    ])->update([
                        'stock' => $data['stock'][$key]
                    ]);
                }
            }

            return redirect()->back()->with('success_message', 'Product Attributes have been updated successfully!');
        }
    }

    public function addImages(Request $request, $id)
    {
        Session::put('page', 'products');

        $product = Product::select('id', 'product_name', 'product_price', 'product_image')->with('images')->find($id);

        if ($request->isMethod('post')) {
            $data = $request->all();

            if ($request->hasFile('images')) {
                $images = $request->file('images');

                foreach ($images as $key => $image) {
                    $image_tmp = Image::make($image);
                    $image_name = $image->getClientOriginalName();
                    $extension = $image->getClientOriginalExtension();
                    $imageName = $image_name . rand(111, 99999) . '.' . $extension;
                    $largeImagePath  = 'front/images/product_images/large/'  . $imageName;
                    $mediumImagePath = 'front/images/product_images/medium/' . $imageName;
                    $smallImagePath  = 'front/images/product_images/small/'  . $imageName;

                    Image::make($image_tmp)->resize(1000, 1000)->save($largeImagePath);
                    Image::make($image_tmp)->resize(500,   500)->save($mediumImagePath);
                    Image::make($image_tmp)->resize(250,   250)->save($smallImagePath);

                    $image = new ProductsImage;
                    $image->image      = $imageName;
                    $image->product_id = $id;
                    $image->save();
                }
            }

            return redirect()->back()->with('success_message', 'Product Images have been added successfully!');
        }

        return view('admin.images.add_images')->with(compact('product'));
    }

    public function deleteImage($id)
    {
        $productImage = ProductsImage::select('image')->where('id', $id)->first();
        $small_image_path  = 'front/images/product_images/small/';
        $medium_image_path = 'front/images/product_images/medium/';
        $large_image_path  = 'front/images/product_images/large/';

        if (file_exists($small_image_path . $productImage->image)) {
            unlink($small_image_path . $productImage->image);
        }

        if (file_exists($medium_image_path . $productImage->image)) {
            unlink($medium_image_path . $productImage->image);
        }

        if (file_exists($large_image_path . $productImage->image)) {
            unlink($large_image_path . $productImage->image);
        }

        ProductsImage::where('id', $id)->delete();

        $message = 'Product Image has been deleted successfully!';

        return redirect()->back()->with('success_message', $message);
    }
}
