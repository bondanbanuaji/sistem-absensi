@extends('layouts.app')

@section('content')
<h3>Tambah Absensi</h3>

@if($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach($errors->all() as $err)
        <li>{{ $err }}</li>
      @endforeach
    </ul>
  </div>
@endif

<form action="{{ route('attendances.store') }}" method="POST" class="mt-3">
  @csrf

  <div class="mb-3">
    <label class="form-label">Siswa</label>
    <select name="student_id" class="form-select" required>
      <option value="">-- Pilih siswa --</option>
      @foreach($students as $s)
        <option value="{{ $s->id }}" {{ old('student_id') == $s->id ? 'selected' : '' }}>
          {{ $s->nis }} — {{ $s->name }} ({{ $s->kelas }})
        </option>
      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label class="form-label">Tanggal</label>
    <input type="date" name="date" class="form-control" value="{{ old('date', request()->query('date', date('Y-m-d'))) }}" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Status</label>
    <select name="status" class="form-select" required>
      <option value="present" {{ old('status')=='present' ? 'selected' : '' }}>Hadir</option>
      <option value="absent" {{ old('status')=='absent' ? 'selected' : '' }}>Alpha</option>
      <option value="sick" {{ old('status')=='sick' ? 'selected' : '' }}>Sakit</option>
      <option value="permission" {{ old('status')=='permission' ? 'selected' : '' }}>Izin</option>
    </select>
  </div>

  <div class="row">
    <div class="col-md-6 mb-3">
      <label class="form-label">Time In</label>
      <input type="time" name="time_in" class="form-control" value="{{ old('time_in') }}">
    </div>
    <div class="col-md-6 mb-3">
      <label class="form-label">Time Out</label>
      <input type="time" name="time_out" class="form-control" value="{{ old('time_out') }}">
    </div>
  </div>

  <div class="mb-3">
    <label class="form-label">Catatan</label>
    <input type="text" name="note" class="form-control" value="{{ old('note') }}">
  </div>

  <button class="btn btn-success">Simpan</button>
  <a href="{{ route('attendances.index', ['date' => request()->query('date', date('Y-m-d'))]) }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
