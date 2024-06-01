<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use App\Models\Category;
use App\Models\Section;

class CategoryController extends Controller
{
    // Menampilkan halaman categories di dashboard admin pada views admin/categories/categories.blade.php
    public function categories()
    {
        Session::put('page', 'categories');

        $categories = Category::with('section')->get();

        return view('admin.categories.categories')->with(compact('categories'));
    }

    public function addEditCategory(Request $request, $id = null)
    {
        Session::put('page', 'categories');

        if ($id == '') {
            $title = 'Add Category';
            $category = new Category();
            $getCategories = array();
            $message = 'Berhasil menambahkan category';
        } else {
            $title = 'Edit Category';
            $category = Category::find($id);
            $getCategories = Category::where([
                'section_id' => $category['section_id']
            ])->get();
            $message = 'Berhasil memperbarui category';
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'category_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'section_id'    => 'required',
                'url'           => 'required',
            ];
            $customMessages = [
                'category_name.required' => 'Category Name is required',
                'category_name.regex'    => 'Valid Category Name is required',
                'section_id.required'    => 'Section is required',
                'url.required'           => 'Category URL is required',
            ];

            $this->validate($request, $rules, $customMessages);

            if ($data['category_discount'] == '') {
                $data['category_discount'] = 0;
            }

            $category->section_id        = $data['section_id'];
            $category->category_name     = $data['category_name'];
            $category->category_discount = $data['category_discount'];
            $category->description       = $data['description'];
            $category->url               = $data['url'];
            $category->save();

            return redirect('admin/categories')->with('success_message', $message);
        }

        $getSections = Section::get();

        return view('admin.categories.add_edit_category')->with(compact('title', 'category', 'getSections', 'getCategories'));
    }

    public function deleteCategory($id)
    {
        Category::where('id', $id)->delete();

        $message = 'Berhasil menghapus category';

        return redirect()->back()->with('success_message', $message);
    }
}
