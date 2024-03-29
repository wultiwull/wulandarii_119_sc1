<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class StudentApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $students = Student::all()->toJson(JSON_PRETTY_PRINT);
        return response($students, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validateData = Validator::make($request->all(), [
            'nim' => 'required|size:8,unique:student,nim',
            'nama' => 'required|min:3|max:50',
            'jenis_kelamin' => 'required|in:P,L',
            'jurusan' => 'required',
            'alamat' => '',
            'image' => 'required|file|image|max:1000',
        ]);
        if ($validateData->fails()) {
            return response($validateData->errors(), 400);
        } else {
            $mahasiswa = new Student();
            $mahasiswa->nim = $request->nim;
            $mahasiswa->name = $request->nama;
            $mahasiswa->gender = $request->jenis_kelamin;
            $mahasiswa->departement = $request->jurusan;
            $mahasiswa->address = $request->alamat;
            if ($request->hasFile('image')) {
                $extFile = $request->image->getClientOriginalExtension();
                $namaFile = 'user-' . time() . "." . $extFile;
                $path = $request->image->move('assets/images', $namaFile);
                $mahasiswa->image = $path;
            }
            $mahasiswa->save();
            return response()->json([
                "message" => "student record created"
            ], 201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mahasiswa = Student::find($id);

        if (!$mahasiswa) {
            return response()->json([
                "message" => "Student not found"
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Student::where('id', $id)->exists()) {
            $validateData = Validator::make($request->all(), [
                'nim' => 'required|size:8|unique:students,nim,' . $id,
                'nama' => 'required|min:3|max:50',
                'jenis_kelamin' => 'required|in:P,L',
                'jurusan' => 'required',
                'alamat' => '',
                'image' => 'required|file|image|max:1000',
            ]);
    
            if ($validateData->fails()) {
                return response($validateData->errors(), 400);
            } else {
                $mahasiswa = Student::find($id);
                $mahasiswa->nim = $request->nim;
                $mahasiswa->name = $request->nama;
                $mahasiswa->gender = $request->jenis_kelamin;
                $mahasiswa->departement = $request->jurusan;
                $mahasiswa->address = $request->alamat;
    
                if ($request->hasFile('image')) {
                    if ($mahasiswa->image) {
                        $imagePath = public_path($mahasiswa->image);
    
                        if (file_exists($imagePath)) {
                            File::delete($imagePath);
                        }
                    }
    
                    $extFile = $request->file('image')->getClientOriginalExtension();
                    $namaFile = 'user-' . time() . "." . $extFile;
                    $path = $request->file('image')->move('assets/images', $namaFile);
                    $mahasiswa->image = $path;
                }
    
                $mahasiswa->save();
    
                return response()->json([
                    "message" => "student record updated",
                    "data" => $mahasiswa  // Sertakan data mahasiswa yang diperbarui dalam respons jika diperlukan
                ], 200);
            }
        } else {
            return response()->json([
                "message" => "Student not found"
            ], 404);
        }
    }
    



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $mahasiswa = Student::find($id);

    if (!$mahasiswa) {
        return response()->json([
            "message" => "Student not found"
        ], 404);
    }

    // Hapus file gambar jika ada
    if ($mahasiswa->image) {
        File::delete(public_path($mahasiswa->image));
    }

    // Hapus data mahasiswa
    $mahasiswa->delete();

    return response()->json([
        "message" => "student record deleted"
    ], 200);
}
}
