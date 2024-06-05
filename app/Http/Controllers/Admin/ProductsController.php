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
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    // Menampilkan halaman coupon di dashboard admin pada views admin/products/products.blade.php
    public function products()
    {
        // Menggunakan session untuk sebagai penanda halaman yang sedang digunakan pada sidebar
        Session::put('page', 'products');

        $adminType = Auth::guard('admin')->user()->type;
        $vendor_id = Auth::guard('admin')->user()->vendor_id;
        $products = Product::with(['section:id,name', 'category:id,category_name']);

        if ($adminType == 'vendor') {
            $products->where('vendor_id', $vendor_id);
        }

        $products = $products->get();

        return view('admin.products.products')->with(compact('products'));
    }

    public function addEditProduct(Request $request, $id = null)
    {
        Session::put('page', 'products');
        // Memeriksa apakah $id kosong
        $isAdding = empty($id);

        // Menetapkan judul halaman berdasarkan menambahkan atau memperbarui
        $title = $isAdding ? 'Tambah Produk' : 'Ubah Produk';
        $product = $isAdding ? new Product() : Product::find($id);
        // Menetapkan pesan berhasil berdasarkan menambahkan atau memperbarui
        $message = $isAdding ? 'Berhasil menambahkan produk' : 'Berhasil memperbarui produk';

        if ($request->isMethod('post')) {
            $data = $request->all();
            $validator = Validator::make($request->all(), [
                'category_id'   => 'required',
                'product_name'  => 'required',
                'product_price' => 'required|numeric'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if ($isAdding) {
                $admin_id  = Auth::guard('admin')->user()->id;
                $vendor_id = Auth::guard('admin')->user()->vendor_id;
                $adminType = Auth::guard('admin')->user()->type;
                $product->admin_id   = $admin_id;
                $product->vendor_id  = ($adminType == 'vendor') ? $vendor_id : 0;
                $product->admin_type = $adminType;
            }

            // Mengambil detail kategori berdasarkan category_id yang diterima dari form
            $categoryDetails = Category::find($data['category_id']);
            // Menetapkan section_id produk berdasarkan dari kategori yang dipilih
            $product->section_id  = $categoryDetails['section_id'];
            $product->category_id = $data['category_id'];
            $product->product_name     = $data['product_name'];
            $product->product_price    = $data['product_price'];
            // Menetapkan nilai diskon produk berdasarkan nilai yang diterima dari form, jika tidak ada nilai yang diterima, maka defaultnya adalah 0
            $product->product_discount = $data['product_discount'] ?? 0;
            // Menetapkan berat produk berdasarkan nilai yang diterima dari form, jika tidak ada nilai yang diterima, maka defaultnya adalah 0
            $product->product_weight   = $data['product_weight'] ?? 0;
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
            $product->description      = $data['description'];
            $product->is_bestseller    = !empty($data['is_bestseller']) ? $data['is_bestseller'] : 'No';
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
        // Menghapus gambar produk
        $productImage = Product::find($id, ['product_image']);
        $imagePaths = [
            'front/images/product_images/small/',
            'front/images/product_images/medium/',
            'front/images/product_images/large/'
        ];

        foreach ($imagePaths as $path) {
            $imagePath = $path . $productImage->product_image;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Memperbarui kolom product_image menjadi string kosong
        Product::where('id', $id)->update(['product_image' => '']);

        $message = 'Berhasil menghapus foto produk';

        return redirect()->back()->with('success_message', $message);
    }

    public function addAttributes(Request $request, $id)
    {
        Session::put('page', 'products');
        // Mengambil data produk berdasarkan ID, serta relasi atributnya
        $product = Product::select('id', 'product_name', 'product_price', 'product_image')->with('attributes')->find($id);

        // Jika metode permintaan adalah POST, maka tambahkan atribut produk
        if ($request->isMethod('post')) {
            $data = $request->all();
            foreach ($data['sku'] as $key => $value) {
                if (!empty($value)) {
                    // Memeriksa apakah SKU sudah ada dalam database
                    $skuCount = ProductsAttribute::where('sku', $value)->count();

                    // Jika SKU sudah ada, kembalikan dengan pesan kesalahan
                    if ($skuCount > 0) {
                        return redirect()->back()->with('error_message', 'Tidak dapat menambahkan SKU karena SKU tersebut sudah ada');
                    }

                    // Menambahkan atribut produk baru
                    $attribute = new ProductsAttribute;
                    $attribute->product_id = $id;
                    $attribute->sku        = $value;
                    $attribute->stock      = $data['stock'][$key];
                    $attribute->save();
                }
            }

            // Kembali ke halaman sebelumnya dengan pesan sukses setelah menambahkan atribut produk
            return redirect()->back()->with('success_message', 'Berhasil menambahkan product attributes');
        }

        // Sedangkan kalu bukan metode POST atau bisa GET tampilkan halaman untuk menambah atau memperbarui atribut produk
        return view('admin.attributes.add_edit_attributes', compact('product'));
    }

    public function editAttributes(Request $request)
    {
        Session::put('page', 'products');

        // Kalau permintaan yakni metode POST maka ambil data
        if ($request->isMethod('post')) {
            $data = $request->only(['attributeId', 'stock']);

            // Iterasi melalui setiap id atribut yang diterima dari form
            foreach ($data['attributeId'] as $key => $attribute) {
                // Jika id atribut tidak kosong lakukan pembaruan stok untuk atribut tersebut
                if (!empty($attribute)) {
                    ProductsAttribute::where('id', $attribute)->update(['stock' => $data['stock'][$key]]);
                }
            }

            return redirect()->back()->with('success_message', 'Product Attributes have been updated successfully!');
        }
    }

    public function addImages(Request $request, $id)
    {
        Session::put('page', 'products');

        // Mengambil data produk berdasarkan id serta relasi gambar produk
        $product = Product::select('id', 'product_name', 'product_price', 'product_image')->with('images')->find($id);

        // Jika metode permintaan yakni POST tambahkan gambar produk baru
        if ($request->isMethod('post')) {
            $data = $request->all();

            // Memeriksa apakah ada file gambar yang diupload
            if ($request->hasFile('images')) {
                $images = $request->file('images');

                // Iterasi melalui setiap gambar yang diupload
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
