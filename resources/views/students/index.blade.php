@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h3>Daftar Siswa</h3>
  <a href="{{ route('students.create') }}" class="btn btn-primary">Tambah Siswa</a>
</div>

<table class="table table-striped">
  <thead class="table-dark">
    <tr>
      <th>#</th>
      <th>NIS</th>
      <th>Nama</th>
      <th>Kelas</th>
      <th>Telepon</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach($students as $s)
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td>{{ $s->nis }}</td>
      <td>{{ $s->name }}</td>
      <td>{{ $s->kelas }}</td>
      <td>{{ $s->phone }}</td>
      <td>
        <a href="{{ route('students.edit',$s) }}" class="btn btn-sm btn-warning">Edit</a>
        <form action="{{ route('students.destroy',$s) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin?')">
          @csrf @method('DELETE')
          <button class="btn btn-sm btn-danger">Hapus</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

{{ $students->links() }}
@endsection
