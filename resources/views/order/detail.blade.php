@extends('layout.app')
@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <h1>Order Detail</h1>
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
                <div class="col-md-12">
                    {{-- list of discount --}}
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Produk</th>
                                <th>Gambar</th>
                                <th>Harga</th>
                                <th>Quantity</th>
                                <th>Lihat Produk</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($datas) === 0)
                                <tr>
                                    <td colspan="6" class="text-center">Order Kosong</td>
                                </tr>
                            @endif
                            @foreach ($datas as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->cart->product->name }}</td>
                                    <td><img src="{{$data->cart->product->image ? asset('/images/' . $data->cart->product->image) : asset('/images/default.jpg')}}" alt="product image" height="130px" width="150px"></td>
                                    <td>Rp.{{ $data->cart->total_price }}</td>
                                    <td>{{ $data->cart->quantity }}</td>
                                    <td>
                                        {{-- see order detail --}}
                                        <a href="/product/detail/{{ $data->id }}"><i class="bi bi-eye-fill"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection