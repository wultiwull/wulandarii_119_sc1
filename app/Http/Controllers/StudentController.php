<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use File;


class StudentController extends Controller
{
    //x
    public function create()
    {
        return view('student.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nim' => 'required|size:8|unique:students',
            'nama' => 'required|min:3|max:50',
            'jenis_kelamin' => 'required|in:P,L',
            'jurusan' => 'required',
            'alamat' => '',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:1000',

        ]);
    
        // Check if validation passes before creating and saving the new student
        $mahasiswa = new Student();
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
    
        
        return redirect()->route('student.index');
    }

    public function index()
    {
        $mahasiswas = Student::all();
        return view('student.index', ['students' => $mahasiswas]);
    }

    public function show($student_id)
    {
        $result = Student::findOrFail($student_id);
        return view('student.show', ['student' => $result]);
    }

    public function edit($student_id)
    {
        $result = Student::findOrFail($student_id);
        return view('student.edit', ['student' => $result]);
    }

    public function update(Request $request, Student $student)
    {
        $validateData = $request->validate([
            'nim' => 'required|size:8|unique:students,nim,' . $student->id,
            'nama' => 'required|min:3|max:50',
            'jenis_kelamin' => 'required|in:P,L',
            'jurusan' => 'required',
            'alamat' => '', // Jika kolom boleh kosong
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:1000',

        ]);
    
        $student->nim = $validateData['nim'];
        $student->name = $validateData['nama'];
        $student->gender = $validateData['jenis_kelamin'];
        $student->departement = $validateData['jurusan'];
        $student->address = $validateData['alamat'];
    
        if ($request->hasFile('image')) {
            $extFile = $request->file('image')->getClientOriginalExtension();
            $namaFile = 'user-' . time() . "." . $extFile;
            $path = $request->file('image')->move('assets/images', $namaFile);
            $student->image = $path;
        }
    
        $student->save();
    
        return redirect()->route('student.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy(Request $request, Student $student)
    {
        $student->delete();
        return redirect()->route('student.index');
    }
}
