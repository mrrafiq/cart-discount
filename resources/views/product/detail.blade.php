@extends('layout.app')
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mb-3">Detail Produk</h1>
                @if(session('error'))
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
                @endif
               {{-- success flash --}}
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <img src="{{ $data->image ? asset('/images/' . $data->image) : asset('/images/default.jpg') }}" class="img-fluid" alt="...">
                    </div>
                    <div class="col-md-6">
                        <h3>{{ $data->name }}</h3>
                        <h4 class="text-success">Rp.{{ $data->price }}</h4>
                        <p>Stok: {{ $data->stock }}</p>
                        <h5>Deskripsi:</h5>
                        <p>{{ $data->description }}</p>
                        {{-- registered user only--}}
                        <div class="">
                            @hasrole('customer')
                            <form action="{{route('cart.store', ['id' => $data->id])}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6 col-3">
                                        <div class="mb-3">
                                            <label for="quantity" class="form-label">Jumlah</label>
                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                <button type="button" class="btn btn-outline-success" id="btn-minus">-</button>
                                                <input type="text" class="form-control text-center" id="quantity" name="quantity" value="1">
                                                <button type="button" class="btn btn-outline-success" id="btn-plus">+</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success text-center"><span><i class="bi bi-cart-plus-fill"></i></span> Tambahkan ke keranjang</button>
                                </div>
                            </form>
                            @endhasrole
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3">
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // make quantity input number works
        const btnMinus = document.getElementById('btn-minus');
        const btnPlus = document.getElementById('btn-plus');
        const quantity = document.getElementById('quantity');
        btnMinus.addEventListener('click', function() {
            if (parseInt(quantity.value) > 1) {
                quantity.value = parseInt(quantity.value) - 1;
            }
        });
        btnPlus.addEventListener('click', function() {
            quantity.value = parseInt(quantity.value) + 1;
        });
    </script>
@endsection