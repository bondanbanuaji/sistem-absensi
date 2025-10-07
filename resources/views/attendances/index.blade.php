@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h3>Absensi — {{ \Carbon\Carbon::parse($date)->format('d M Y') }}</h3>

  <div class="d-flex gap-2">
    <form action="{{ route('attendances.index') }}" method="GET" class="d-flex gap-2">
      <input type="date" name="date" value="{{ $date }}" class="form-control form-control-sm">
      <button class="btn btn-sm btn-outline-primary">Tampilkan</button>
    </form>

    <a href="{{ route('attendances.create') }}?date={{ $date }}" class="btn btn-primary btn-sm">Tambah Absen</a>
  </div>
</div>

@if($attendances->isEmpty())
  <div class="alert alert-secondary">Belum ada data absensi untuk tanggal ini.</div>
@else
  <table class="table table-striped">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>NIS</th>
        <th>Nama</th>
        <th>Status</th>
        <th>Time In</th>
        <th>Time Out</th>
        <th>Note</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($attendances as $a)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $a->student->nis }}</td>
        <td>
          <a href="{{ route('students.show', $a->student) }}">
            {{ $a->student->name }}
          </a>
        </td>
        <td>{{ strtoupper($a->status) }}</td>
        <td>{{ $a->time_in ?? '-' }}</td>
        <td>{{ $a->time_out ?? '-' }}</td>
        <td>{{ $a->note ?? '-' }}</td>
        <td>
          <a href="{{ route('attendances.edit', $a) }}" class="btn btn-sm btn-warning">Edit</a>

          <form action="{{ route('attendances.destroy', $a) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data absensi ini?')">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-danger">Hapus</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
@endif
@endsection
