<?php

namespace App\Http\Controllers;

use App\Models\AdminLTEStudent;

use Illuminate\Http\Request;

class AdminLTEStudentController extends Controller
{
    //

    public function index()
    {
        $mahasiswas = AdminlteStudent::all();
        return view('adminlte.student.index', ['students' => $mahasiswas]);
    }



    public function create()
    {
        $data['module']['name'] = "Tambah Mahasiswa";
        return view('adminlte.student.create', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nim' => 'required|size:8|unique:adminlte_students',
            'nama' => 'required|min:3|max:50',
            'jenis_kelamin' => 'required|in:P,L',
            'jurusan' => 'required',
            'alamat' => '',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:1000',
        ]);

        $mahasiswa = new AdminLTEStudent();
        $mahasiswa->nim = $validateData['nim'];
        $mahasiswa->name = $validateData['nama'];
        $mahasiswa->gender = $validateData['jenis_kelamin'];
        $mahasiswa->departement = $validateData['jurusan'];
        $mahasiswa->address = $validateData['alamat'];
        if ($request->hasFile('image')) {
            $extFile = $request->file('image')->getClientOriginalExtension();
            $namaFile = 'user-' . time() . "." . $extFile;
            $path = $request->file('image')->move('assets/images', $namaFile);
            $mahasiswa->image = $path;
        }
        $mahasiswa->save();

        return redirect()->route('adminlte.student.index');
    }

    // Di dalam AdminLTEStudentController.php
    public function show($student_id)
    {
        $adminlteStudent = AdminLTEStudent::findOrFail($student_id);
        return view('adminlte.student.show', ['adminlteStudent' => $adminlteStudent]);
    }


    public function edit($student_id)
    {
        $result = AdminLTEStudent::findOrFail($student_id);
        return view('adminlte.student.edit', ['adminlteStudent' => $result]);
    }
    public function destroy($student_id)
    {
        $mahasiswa = AdminLTEStudent::findOrFail($student_id);

        // Hapus gambar terkait jika ada
        if ($mahasiswa->image) {
            unlink(public_path($mahasiswa->image));
        }

        $mahasiswa->delete();

        return redirect()->route('adminlte.student.index')->with('pesan', 'Data mahasiswa berhasil dihapus');
    }


    public function update(Request $request, $student_id)
    {
        $validateData = $request->validate([
            'nim' => 'required|size:8|unique:adminlte_students,nim,' . $student_id,
            'nama' => 'required|min:3|max:50',
            'jenis_kelamin' => 'required|in:P,L',
            'jurusan' => 'required',
            'alamat' => 'nullable',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:1000',
        ]);

        $mahasiswa = AdminLTEStudent::findOrFail($student_id);
        $mahasiswa->nim = $validateData['nim'];
        $mahasiswa->name = $validateData['nama'];
        $mahasiswa->gender = $validateData['jenis_kelamin'];
        $mahasiswa->departement = $validateData['jurusan'];
        $mahasiswa->address = $validateData['alamat'];

        if ($request->hasFile('image')) {
            $extFile = $request->file('image')->getClientOriginalExtension();
            $namaFile = 'user-' . time() . "." . $extFile;
            $path = $request->file('image')->move('assets/images', $namaFile);
            $mahasiswa->image = $path;
        }

        $mahasiswa->save();

        return redirect()->route('adminlte.student.index')->with('pesan', 'Data mahasiswa berhasil diperbarui');
    }
}
