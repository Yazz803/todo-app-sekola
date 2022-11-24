@extends('dashboard.layout.main')

@section('content')
<div class="container mt-5 w-50">
    <form action="{{ route('dashboard.store') }}" method="POST">
        @csrf
        <!-- Name input -->
        <div class="form-outline mb-4">
          <label class="form-label @error('title') text-danger @enderror">Title</label>
          <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" />
          @error('title')
            <p class="text-danger fw-bold">{{ $message }}</p>
          @enderror
        </div>

        <!-- Name input -->
        <div class="form-outline mb-4">
          <label class="form-label @error('date') text-danger @enderror">Date</label>
          <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" />
          @error('date')
            <p class="text-danger fw-bold">{{ $message }}</p>
          @enderror
        </div>
      
        <!-- Message input -->
        <div class="form-outline mb-4">
          <label class="form-label @error('description') text-danger @enderror">Description</label>
          <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="4"></textarea>
          @error('description')
            <p class="text-danger fw-bold">{{ $message }}</p>
          @enderror
        </div>
      
        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block mb-4">
          Submit
        </button>
    </form>
</div>
@endsection