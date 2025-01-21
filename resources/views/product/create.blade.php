@extends('layout.app')
@section('content')
<div class="container my-5">
    <div class="card">
        <div class="card-header">
            <h1>Tambah Produk</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="code" class="form-label">Kode Produk</label>
                                    <input type="text" class="form-control" id="code" name="code">
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Produk</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Harga</label>
                                    <input type="number" class="form-control" id="price" name="price">
                                </div>
                                <div class="mb-3">
                                    <label for="stock" class="form-label">Stok</label>
                                    <input type="number" class="form-control" id="stock" name="stock">
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="description" name="description"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="image">Foto</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>
                                <div class="mb-3 text-end">
                                    <button type="submit" class="btn" style="background-color: seagreen; color: white">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection