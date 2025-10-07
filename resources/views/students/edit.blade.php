@extends('layouts.app')

@section('content')
<h3>Edit Siswa</h3>

<form action="{{ route('students.update', $student) }}" method="POST" enctype="multipart/form-data" class="mt-3">
  @csrf @method('PUT')
  
  <div class="mb-3">
    <label>NIS</label>
    <input type="text" name="nis" class="form-control" value="{{ $student->nis }}" required>
  </div>

  <div class="mb-3">
    <label>Nama</label>
    <input type="text" name="name" class="form-control" value="{{ $student->name }}" required>
  </div>

  <div class="mb-3">
    <label>Kelas</label>
    <input type="text" name="kelas" class="form-control" value="{{ $student->kelas }}">
  </div>

  <div class="mb-3">
    <label>Telepon</label>
    <input type="text" name="phone" class="form-control" value="{{ $student->phone }}">
  </div>

  <div class="mb-3">
    <label>Foto</label>
    <input type="file" name="photo" class="form-control">
  </div>

  <button type="submit" class="btn btn-warning">Perbarui</button>
  <a href="{{ route('students.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
