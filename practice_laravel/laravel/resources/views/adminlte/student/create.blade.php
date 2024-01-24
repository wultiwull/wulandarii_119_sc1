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
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ $data['module']['name'] }}
            </h1>
            <div class="container pt-4 bg-white">
                <div class="row">
                    <div class="col-md-8 col-xl-6">
                        <h1>Pendaftaran Mahasiswa</h1>
                        <hr>
                        <form action="{{ route('adminlte.student.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="nim">NIM</label>
                                <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim"
                                    name="nim" value="{{ old('nim') }}">
                                @error('nim')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                    name="nama" value="{{ old('nama') }}">
                                @error('nama')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki_laki"
                                            value="L" {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="laki_laki">Laki-laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan"
                                            value="P" {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }}>
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
                                    <option value="Teknik Informatika"
                                        {{ old('jurusan') == 'Teknik Informatika' ? 'selected' : '' }}>
                                        Teknik Informatika
                                    </option>
                                    <!-- Tambahkan opsi jurusan lain sesuai kebutuhan -->
                                </select>
                                @error('jurusan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control" id="alamat" rows="3"
                                    name="alamat">{{ old('alamat') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Gambar Profile</label>
                                <input type="file" class="form-control-file" id="image" name="image">
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary mb-2">Daftar</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
        </section>
        <!-- /.content -->
    </div>
@endsection
