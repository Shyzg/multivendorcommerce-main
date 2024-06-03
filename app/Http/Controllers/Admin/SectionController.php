<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Section;

class SectionController extends Controller
{
    // Menampilkan halaman coupon di dashboard admin pada views admin/sections/sections.blade.php
    public function sections()
    {
        // Menggunakan session untuk sebagai penanda halaman yang sedang digunakan pada sidebar
        Session::put('page', 'sections');

        $sections = Section::get();

        return view('admin.sections.sections')->with(compact('sections'));
    }

    public function addEditSection(Request $request, $id = null)
    {
        Session::put('page', 'sections');

        if ($id == '') {
            $title = 'Tambah Section';
            $section = new Section();
            $message = 'Berhasil menambahkan section';
        } else {
            $title = 'Ubah Section';
            $section = Section::find($id);
            $message = 'Berhasil memperbarui section';
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'section_name' => 'required'
            ];
            $customMessages = [
                'section_name.required' => 'Nama section harus diisi'
            ];

            $this->validate($request, $rules, $customMessages);

            $section->name   = $data['section_name'];
            $section->save();

            return redirect('admin/products')->with('success_message', $message);
        }

        return view('admin.sections.add_edit_section')->with(compact('title', 'section'));
    }

    public function deleteSection($id)
    {
        Section::where('id', $id)->delete();

        $message = 'Berhasil menghapus section';

        return redirect()->back()->with('success_message', $message);
    }
}
