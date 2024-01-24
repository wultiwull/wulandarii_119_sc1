@extends('admin_layout.app')

@section('header')
    @include('admin_layout.header')
@endsection

@section('leftbar')
    @include('admin_layout.leftbar')
@endsection

@section('rightbar')
    @include('admin_layout.rightbar')
@endsection

@section('content')
<div class="content-wrapper">
    <div class="container pt-4 bg-white">
        <div class="row">
            <div class="col-md-8 col-xl-6">
                <h1>Edit Mahasiswa</h1>
                <hr>

                <form action="{{ route('adminlte.student.update', ['student_id' => $adminlteStudent->id]) }}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf

                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="text"
                            class="form-control @error('nim') is-invalid @enderror"
                            id="nim" name="nim" value="{{ old('nim') ?? $adminlteStudent->nim }}">
                        @error('nim')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') ?? $adminlteStudent->name }}">
                        @error('nama')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki_laki" value="L" {{ (old('jenis_kelamin') ?? $adminlteStudent->gender) == 'L' ? 'checked': '' }}>
                                <label class="form-check-label" for="laki_laki">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="P" {{ (old('jenis_kelamin') ?? $adminlteStudent->gender) == 'P' ? 'checked': '' }}>
                                <label class="form-check-label" for="perempuan">Perempuan</label>
                            </div>
                            @error('jenis_kelamin')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        <select class="form-control" name="jurusan" id="jurusan">
                            <option value="Teknik Informatika" {{ (old('jurusan') ?? $adminlteStudent->departement) == 'Teknik Informatika' ? 'selected': '' }}>Teknik Informatika</option>
                            <option value="Sistem Informasi" {{ (old('jurusan') ?? $adminlteStudent->departement) == 'Sistem Informasi' ? 'selected': '' }}>Sistem Informasi</option>
                            <option value="Ilmu Komputer" {{ (old('jurusan') ?? $adminlteStudent->departement) == 'Ilmu Komputer' ? 'selected': '' }}>Ilmu Komputer</option>
                            <option value="Teknik Komputer" {{ (old('jurusan') ?? $adminlteStudent->departement) == 'Teknik Komputer' ? 'selected': '' }}>Teknik Komputer</option>
                            <option value="Teknik Telekomunikasi" {{ (old('jurusan') ?? $adminlteStudent->departement) == 'Teknik Telekomunikasi' ? 'selected': '' }}>Teknik Telekomunikasi</option>
                        </select>
                        @error('jurusan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" id="alamat" rows="3" name="alamat">{{ old('alamat') ?? $adminlteStudent->address}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="image">Gambar Profile</label>
                        <br><img height="150px" src="{{ url('') }}/{{ $adminlteStudent->image }}" class="rounded" alt="">
                        <input type="file" class="form-control-file" id="image" name="image">
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary mb-2">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
