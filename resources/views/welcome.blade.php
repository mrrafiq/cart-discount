@extends('layout.app')
@section('content')
    <div class="container my-5">
        {{-- search bar --}}
        <div class="row">

        </div>
        {{-- list of product --}}
        <div class="row">
            @foreach ($datas as $data)
                <div class="col-md-4">
                    <a href="{{route('product.detail', ['id' => $data->id])}}" class="text-decoration-none text-dark">
                        <div class="card mb-3">
                            <img src="{{ $data->image ? asset('/images/' . $data->image) : asset('/images/default.jpg') }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h6 class="card-title">{{ $data->name }}</h5>
                                <h4 class="text-success">Rp.{{ $data->price }}</h4>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
