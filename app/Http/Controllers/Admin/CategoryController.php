<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
use App\Models\Section;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // Menampilkan halaman categories di dashboard admin pada views admin/categories/categories.blade.php
    public function categories()
    {
        // Menggunakan session untuk sebagai penanda halaman yang sedang digunakan pada sidebar
        Session::put('page', 'categories');

        $categories = Category::with('section')->get();

        return view('admin.categories.categories')->with(compact('categories'));
    }

    public function addEditCategory(Request $request, $id = null)
    {
        // Menetapkan halaman saat ini
        Session::put('page', 'categories');

        // Menetapkan judul halaman berdasarkan menambahkan atau memperbarui
        $title = $id ? 'Ubah Kategori' : 'Tambah Kategori';
        $category = $id ? Category::find($id) : new Category();
        $getCategories = $id ? Category::where('section_id', $category->section_id)->get() : [];
        // Menetapkan pesan berhasil halaman berdasarkan menambahkan atau memperbarui
        $message = $id ? 'Berhasil memperbarui kategori' : 'Berhasil menambahkan kategori';

        // Memproses data jika permintaan adalah POST
        if ($request->isMethod('post')) {
            $data = $request->all();
            $validator = Validator::make($request->all(), [
                'category_name' => 'required',
                'category_discount' => 'required',
                'section_id' => 'required',
                'url' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $category->section_id = $data['section_id'];
            $category->category_name = $data['category_name'];
            $category->category_discount = $request->input('category_discount', 0);
            $category->url = $data['url'];
            $category->save();

            return redirect('admin/categories')->with('success_message', $message);
        }

        $getSections = Section::get();

        return view('admin.categories.add_edit_category', compact('title', 'category', 'getSections', 'getCategories'));
    }

    public function deleteCategory($id)
    {
        Category::where('id', $id)->delete();

        $message = 'Berhasil menghapus category';

        return redirect()->back()->with('success_message', $message);
    }
}
