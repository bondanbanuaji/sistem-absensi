@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-start">
      <div>
        <h3>{{ $student->name }}</h3>
        <p class="mb-1"><strong>NIS:</strong> {{ $student->nis }}</p>
        <p class="mb-1"><strong>Kelas:</strong> {{ $student->kelas ?? '-' }}</p>
        <p class="mb-1"><strong>Telepon:</strong> {{ $student->phone ?? '-' }}</p>
        <p class="text-muted"><small>Terdaftar: {{ $student->created_at->format('d M Y') }}</small></p>
      </div>

      <div class="text-end">
        @if($student->photo)
          <img src="{{ asset('storage/'.$student->photo) }}" alt="Photo {{ $student->name }}" class="img-thumbnail" style="max-width:150px;">
        @else
          <div class="border rounded d-inline-block text-center p-3" style="width:150px; height:150px; line-height:120px;">
            <small class="text-muted">No Photo</small>
          </div>
        @endif
      </div>
    </div>

    <hr>

    <div class="d-flex gap-2">
      <a href="{{ route('students.edit', $student) }}" class="btn btn-warning">Edit</a>

      <form action="{{ route('students.destroy', $student) }}" method="POST" onsubmit="return confirm('Yakin hapus siswa ini?')">
        @csrf @method('DELETE')
        <button class="btn btn-danger">Hapus</button>
      </form>

      <a href="{{ route('students.index') }}" class="btn btn-secondary ms-auto">Kembali</a>
    </div>
  </div>
</div>

{{-- Optional: daftar riwayat absensi singkat --}}
<div class="mt-4">
  <h5>Riwayat Absensi (5 terbaru)</h5>
  @php $recent = $student->attendances()->latest('date')->limit(5)->get(); @endphp
  @if($recent->isEmpty())
    <div class="text-muted">Belum ada catatan absensi.</div>
  @else
    <table class="table table-sm">
      <thead>
        <tr><th>Tanggal</th><th>Status</th><th>Time In</th><th>Note</th></tr>
      </thead>
      <tbody>
        @foreach($recent as $r)
          <tr>
            <td>{{ $r->date->format('d M Y') }}</td>
            <td>{{ ucfirst($r->status) }}</td>
            <td>{{ $r->time_in ?? '-' }}</td>
            <td>{{ $r->note ?? '-' }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endif
</div>
@endsection
