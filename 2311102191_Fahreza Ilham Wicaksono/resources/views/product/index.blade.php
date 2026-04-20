@extends('layout')

@section('content')
    <div class="container">
        <div class="card">
            <h1>Products <b>NguawiStore</b></h1>

            <div class="btn-container" style="">
                <a href="{{ route('products.create') }}" class="btn btn-add">
                    <i class="fa fa-plus"></i> Tambah Produk
                </a>

                <form action="{{ route('logout') }}" method="post" style="margin:0;">
                    @csrf

                    <button type="submit" class="btn btn-logout">
                        <i class="fa fa-right-from-bracket"></i> Logout
                    </button>
                </form>
            </div>

            <table id="productTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category }}</td>
                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>

                            <td style="text-align:center; vertical-align:middle;">
                                <div style="display:flex; gap:8px; justify-content:center; align-items:center;">
                                    <a href="{{ route('products.show', $product->uuid) }}" class="btn btn-edit">
                                        <i class="fa fa-info"></i>
                                    </a>

                                    <a href="{{ route('products.edit', $product->uuid) }}" class="btn btn-edit">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <form action="{{ route('products.destroy', $product->uuid) }}" method="POST"
                                        style="margin:0;">
                                        @csrf
                                        @method('delete')

                                        <button type="button" class="btn btn-delete confirm-delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#productTable').DataTable();

            // SweetAlert Success
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    confirmButtonColor: '#6d4c41'
                });
            @endif

            // SweetAlert Confirm Delete
            $('.confirm-delete').click(function(e) {
                let form = $(this).closest('form');
                Swal.fire({
                    title: 'Apakah yakin?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d32f2f',
                    cancelButtonColor: '#a1887f',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
