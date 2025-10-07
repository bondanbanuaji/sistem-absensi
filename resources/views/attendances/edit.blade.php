@extends('layouts.app')

@section('content')
<h3>Edit Absensi</h3>

@if($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach($errors->all() as $err)
        <li>{{ $err }}</li>
      @endforeach
    </ul>
  </div>
@endif

<form action="{{ route('attendances.update', $attendance) }}" method="POST" class="mt-3">
  @csrf @method('PUT')

  <div class="mb-3">
    <label class="form-label">Siswa</label>
    <select name="student_id" class="form-select" required>
      @foreach($students as $s)
        <option value="{{ $s->id }}" {{ (old('student_id', $attendance->student_id) == $s->id) ? 'selected' : '' }}>
          {{ $s->nis }} — {{ $s->name }} ({{ $s->kelas }})
        </option>
      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label class="form-label">Tanggal</label>
    <input type="date" name="date" class="form-control" value="{{ old('date', $attendance->date->format('Y-m-d')) }}" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Status</label>
    <select name="status" class="form-select" required>
      <option value="present" {{ old('status', $attendance->status)=='present' ? 'selected' : '' }}>Hadir</option>
      <option value="absent" {{ old('status', $attendance->status)=='absent' ? 'selected' : '' }}>Alpha</option>
      <option value="sick" {{ old('status', $attendance->status)=='sick' ? 'selected' : '' }}>Sakit</option>
      <option value="permission" {{ old('status', $attendance->status)=='permission' ? 'selected' : '' }}>Izin</option>
    </select>
  </div>

  <div class="row">
    <div class="col-md-6 mb-3">
      <label class="form-label">Time In</label>
      <input type="time" name="time_in" class="form-control" value="{{ old('time_in', $attendance->time_in) }}">
    </div>
    <div class="col-md-6 mb-3">
      <label class="form-label">Time Out</label>
      <input type="time" name="time_out" class="form-control" value="{{ old('time_out', $attendance->time_out) }}">
    </div>
  </div>

  <div class="mb-3">
    <label class="form-label">Catatan</label>
    <input type="text" name="note" class="form-control" value="{{ old('note', $attendance->note) }}">
  </div>

  <button class="btn btn-warning">Perbarui</button>
  <a href="{{ route('attendances.index', ['date' => $attendance->date->format('Y-m-d')]) }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
