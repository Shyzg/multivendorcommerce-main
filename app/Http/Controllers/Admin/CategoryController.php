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
    public function categories()
    {
        Session::put('page', 'categories');

        $categories = Category::with(['section'])->get()->toArray();

        return view('admin.categories.categories')->with(compact('categories'));
    }

    public function addEditCategory(Request $request, $id = null)
    {
        Session::put('page', 'categories');

        if ($id == '') {
            $title = 'Add Category';
            $category = new Category();
            $getCategories = array();
            $message = 'Category added successfully!';
        } else {
            $title = 'Edit Category';
            $category = Category::find($id);
            $getCategories = Category::where([
                'section_id' => $category['section_id']
            ])->get();
            $message = 'Category updated successfully!';
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

            if ($request->hasFile('category_image')) {
                $image_tmp = $request->file('category_image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $imagePath = 'front/images/category_images/' . $imageName;

                    Image::make($image_tmp)->save($imagePath);

                    $category->category_image = $imageName;
                }
            } else {
                $category->category_image = '';
            }

            $category->section_id        = $data['section_id'];
            $category->category_name     = $data['category_name'];
            $category->category_discount = $data['category_discount'];
            $category->description       = $data['description'];
            $category->url               = $data['url'];
            $category->save();

            return redirect('admin/categories')->with('success_message', $message);
        }

        $getSections = Section::get()->toArray();

        return view('admin.categories.add_edit_category')->with(compact('title', 'category', 'getSections', 'getCategories'));
    }

    public function deleteCategory($id)
    {
        Category::where('id', $id)->delete();

        $message = 'Category has been deleted successfully!';

        return redirect()->back()->with('success_message', $message);
    }

    public function deleteCategoryImage($id)
    {
        $categoryImage = Category::select('category_image')->where('id', $id)->first();
        $category_image_path = 'front/images/category_images/';

        if (file_exists($category_image_path . $categoryImage->category_image)) {
            unlink($category_image_path . $categoryImage->category_image);
        }

        Category::where('id', $id)->update(['category_image' => '']);

        $message = 'Category Image has been deleted successfully!';

        return redirect()->back()->with('success_message', $message);
    }
}
