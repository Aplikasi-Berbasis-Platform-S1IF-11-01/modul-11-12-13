@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 fw-bold">Dashboard Inventori</h2>

    <div class="row g-3">
        <div class="col-md-3">
            <div class="card shadow rounded-4 border-0">
                <div class="card-body text-center">
                    <h6>Total Produk</h6>
                    <h2 class="fw-bold">{{ $total }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow rounded-4 border-0">
                <div class="card-body text-center">
                    <h6>Stok Menipis</h6>
                    <h2 class="fw-bold text-warning">{{ $stokMenipis }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow rounded-4 border-0">
                <div class="card-body text-center">
                    <h6>Stok Habis</h6>
                    <h2 class="fw-bold text-danger">{{ $stokHabis }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow rounded-4 border-0">
                <div class="card-body text-center">
                    <h6>Nilai Stok</h6>
                    <h5 class="fw-bold">
                        Rp {{ number_format($nilaiStok, 0, ',', '.') }}
                    </h5>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('products.index') }}" class="btn btn-success">
            Kelola Produk
        </a>
    </div>
</div>
@endsection