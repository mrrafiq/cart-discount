@extends('layout.app')
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12">
                <h1>Produk</h1>
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @elseif(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="row">
                    {{-- add data button --}}
                    <div class="col text-end">
                        <a href="/product/create" class="btn my-3" style="background-color: seagreen; color: white;">Tambah Produk</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        {{-- list of product --}}
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Kode Produk</th>
                                    <th>Stok</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($products) === 0)
                                    <tr>
                                        <td colspan="6" class="text-center">Produk Kosong</td>
                                    </tr>
                                    
                                @endif
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->code }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>
                                            <a href="/product/edit/{{ $product->id }}"><i class="bi bi-pencil-fill text-warning"></i></a>
                                            <form action="{{route('product.delete', ['id' => $product->id])}}" method="POST" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <i data-bs-toggle="modal" data-bs-target="#confirmModal" class="bi bi-trash3-fill text-danger"></i>
                                                <div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <h1 class="modal-title fs-5" id="exampleModalLabel">Perhatian</h1>
                                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah anda yakin ingin menghapus data ini?
                                                        </div>
                                                        <div class="modal-footer">
                                                          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Urungkan</button>
                                                          <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </div>
                                                      </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                
        </div>
    </div>
@endsection