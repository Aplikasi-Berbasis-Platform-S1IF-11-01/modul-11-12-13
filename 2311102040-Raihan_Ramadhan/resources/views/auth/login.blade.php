@extends('layouts.auth')

@section('content')

<div class="card-custom p-4" style="width: 350px;">
    <h3 class="text-center mb-4">Login Admin</h3>

    <form method="POST" action="/login">
        @csrf

        <input type="email" name="email" class="form-control mb-3" placeholder="Email">
        <input type="password" name="password" class="form-control mb-3" placeholder="Password">

        <button class="btn btn-primary w-100">Login</button>
    </form>

    @if(session('error'))
    <div class="alert alert-danger mt-3 text-center">
        {{ session('error') }}
    </div>
    @endif
</div>

@endsection