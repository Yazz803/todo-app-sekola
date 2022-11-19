@extends('dashboard.layout.main')

@section('content')
<div class="mt-4">
    <h1>Selamat Datang, {{ auth()->user()->name }}!</h1>
</div>
@endsection