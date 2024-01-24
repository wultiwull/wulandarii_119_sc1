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
</h1>
 <div class="container mt-3">
    <div class="row">
        <div class="col-12">
            <h2 class="mr-auto">Tabel Mahasiswa</h2>
            <hr>
            <div class="py-4 d-flex justify-content-end align-items-center">
                <a href="{{ route('adminlte.student.create') }}" class="btn btn-primary">
                    Tambah Mahasiswa
                </a>
            </div>
            @if (session()->has('pesan'))
                <div class="alert alert-success">
                    {{ session()->get('pesan') }}
                </div>
            @endif
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Foto</th>
                        <th>Nim</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Jurusan</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $mahasiswa)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td><img height="30px" src="{{url('')}}/{{$mahasiswa->image}}" class="rounded" alt=""></td>
                        <td><a href="{{ route('adminlte.student.show', ['student_id' => $mahasiswa->id]) }}">{{ $mahasiswa->nim }}</a></td>
                        <td>{{ $mahasiswa->name }}</td>
                        <td>{{ $mahasiswa->gender == 'P' ? 'Perempuan' : 'Laki-laki' }}</td>
                        <td>{{ $mahasiswa->departement }}</td>
                        <td>{{ $mahasiswa->address == '' ? 'N/A' : $mahasiswa->address }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data...</td>
                    </tr>
                @endforelse
                
                </tbody>
            </table>
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