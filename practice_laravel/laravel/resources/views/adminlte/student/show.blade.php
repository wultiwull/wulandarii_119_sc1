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
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="h2 mr-auto">Biodata {{ $adminlteStudent->name }}</h1>
                    <div class="pt-3 d-flex justify-content-end align-items-center">
                        <a href="{{ route('adminlte.student.edit', ['student_id' => $adminlteStudent->id]) }}"
                            class="btn btn-primary me-2">Edit
                        </a>
                            <form action="{{ route('adminlte.student.destroy', ['student_id' => $adminlteStudent->id]) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger ml-3">Hapus</button>
                            </form>
                            
                    </div>
                    <hr>
                    @if (session()->has('pesan'))
                        <div class="alert alert-success">
                            {{ session()->get('pesan') }}
                        </div>
                    @endif
                    <ul>
                        <li>NIM: {{ $adminlteStudent->nim }} </li>
                        <li>Nama: {{ $adminlteStudent->name }} </li>
                        <li>Jenis Kelamin:
                            {{ $adminlteStudent->gender == 'P' ? 'Perempuan' : 'Laki-laki' }}
                        </li>
                        <li>Jurusan: {{ $adminlteStudent->departement }} </li>
                        <li>Alamat:
                            {{ $adminlteStudent->address == '' ? 'N/A' : $adminlteStudent->address }}
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
