@extends('dashboard.layout.main')

@section('content')
<div class="mt-4">
    <h1>Selamat Datang, {{ auth()->user()->name }}!</h1>
    @if($todos->count() > 0)
    <div class="row">
        <h2></h2>
        @foreach($todos as $todo)
        @if($todo->status == false)
        <div class="col-sm-4 mt-5">
          <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-end" style="position: absolute; right:-20px;top:-20px;">
                    <button class="btn btn-secondary mb-2">On-Process</button>
                </div>
              <h5 class="card-title">{{ $loop->iteration.'.' }} {{ $todo->title }} </h5>
              <p>Date : {{ \Carbon\Carbon::parse($todo->date)->format('j F, Y') }}</p>
              <p class="card-text">{{ $todo->description }}</p>
              <div class="action d-flex gap-4">
                <a href="{{ route('dashboard.edit', $todo->id) }}" class="btn btn-dark"><i class="fas fa-edit"></i> Edit</a>
                <form action="{{ route('dashboard.updateStatus', $todo->id) }}" method="POST"> 
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-primary">Selesai!</button>
                </form>
                <form action="{{ route('dashboard.destroy', $todo->id) }}" method="POST">
                    @csrf
                    @method("DELETE")
                    <button type="submit" class="btn btn-danger">Hapus</button>
                  </form>
              </div>
            </div>
          </div>
        </div>
        @else
        <div class="col-sm-4 mt-5">
            <div class="card">
              <div class="card-body">
                  <div class="d-flex justify-content-end" style="position: absolute; right:-20px;top:-20px;">
                      <button class="btn btn-success mb-2">Done!</button>
                  </div>
                <h5 class="card-title">{{ $loop->iteration.'.' }} {{ $todo->title }} </h5>
                <p class="mb-0">Date : {{ \Carbon\Carbon::parse($todo->date)->format('j F, Y') }}</p>
                <p class="fw-bold text-success">Date Done : {{ \Carbon\Carbon::parse($todo->date_done)->format('j F, Y') }}</p>
                <p class="card-text">{{ $todo->description }}</p>

                <form action="{{ route('dashboard.destroy', $todo->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Hapus</button>
                </form>
              </div>
            </div>
          </div>
        @endif
        @endforeach
      </div>
      @else
      <h1 class="text-secondary text-center mt-5">Tidak ada Todo List!</h1>
      @endif
</div>
@endsection