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

        // Menetapkan judul halaman berdasarkan menambahkan atau memperbarui
        $title = $id ? 'Ubah Section' : 'Tambah Section';
        $section = $id ? Section::find($id) : new Section();
        // Menetapkan pesan berhasil halaman berdasarkan menambahkan atau memperbarui
        $message = $id ? 'Berhasil memperbarui section' : 'Berhasil menambahkan section';

        // Memproses data jika permintaan adalah POST
        if ($request->isMethod('post')) {
            // Validasi data masukan
            $validatedData = $request->validate([
                'section_name' => 'required',
            ], [
                'section_name.required' => 'Nama section harus diisi',
            ]);

            $section->name = $validatedData['section_name'];
            $section->save();

            return redirect('admin/sections')->with('success_message', $message);
        }

        return view('admin.sections.add_edit_section', compact('title', 'section'));
    }

    public function deleteSection($id)
    {
        Section::where('id', $id)->delete();

        $message = 'Berhasil menghapus section';

        return redirect()->back()->with('success_message', $message);
    }
}
