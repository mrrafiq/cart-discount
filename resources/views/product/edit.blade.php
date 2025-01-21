@extends('layout.app')
@section('content')
<div class="container my-5">
    <div class="card">
        <div class="card-header">
            <h1>Edit Produk</h1>
        </div>
        {{-- session flash --}}
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('product.update', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="code" class="form-label">Kode Produk</label>
                                    <input type="text" class="form-control" id="code" value="{{$product->code}}" name="code">
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Produk</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{$product->name}}">
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Harga</label>
                                    <input type="number" class="form-control" id="price" name="price" value="{{$product->price}}">
                                </div>
                                <div class="mb-3">
                                    <label for="stock" class="form-label">Stok</label>
                                    <input type="number" class="form-control" id="stock" name="stock" value="{{$product->stock}}">
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="description" name="description">{{$product->description}}</textarea>
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
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{asset('/images/'.$product->image)}}" alt="{{$product->name}}" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection