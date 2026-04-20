@extends('layouts.app')

@section('content')

<div class="card-custom">
    <div class="d-flex justify-content-between mb-3">
        <h3>Data Produk</h3>
        <a href="/products/create" class="btn btn-success">+ Tambah</a>
    </div>

    <table id="table" class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Stock</th>
                <th>Harga</th>
                <th>Gambar</th> <!-- ✅ pindahin ke sini -->
                <th width="150">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($data as $d)
            <tr>
                <td>{{ $d->name }}</td>
                <td>{{ $d->stock }}</td>
                <td>Rp {{ number_format($d->price,0,',','.') }}</td>

                <!-- ✅ GAMBAR DI SINI -->
                <td>
                    @if($d->image)
                        <img src="{{ asset('storage/'.$d->image) }}" width="60" style="border-radius:8px;">
                    @else
                        -
                    @endif
                </td>

                <td>
                    <a href="/products/edit/{{ $d->id }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="/products/{{ $d->id }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>
</div>

@endsection