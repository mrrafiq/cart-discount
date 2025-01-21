@extends('layout.app')
@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <h1>Orders</h1>
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
                                <th>Invoice</th>
                                <th>Dibayar</th>
                                <th>Tanggal Order</th>
                                <th>Customer</th>
                                <th>Aksi</th>
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
                                    <td>{{ $data->code }}</td>
                                    <td>Rp.{{ $data->price_after }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td>{{$data->user->name}}</td>
                                    <td>
                                        {{-- see order detail --}}
                                        <a href="/order/detail/{{ $data->id }}"><i class="bi bi-eye-fill"></i></a>
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