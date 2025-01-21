@extends('layout.app')
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12">
                <h1>Diskon</h1>
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
                        <a href="/discount/create" class="btn my-3" style="background-color: seagreen; color: white;">Tambah Diskon</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        {{-- list of discount --}}
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Diskon</th>
                                    <th>Kode Diskon</th>
                                    <th>Persentase</th>
                                    <th>Nominal Diskon</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Berakhir</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($datas) === 0)
                                    <tr>
                                        <td colspan="6" class="text-center">Diskon Kosong</td>
                                    </tr>
                                @endif
                                @foreach ($datas as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->code }}</td>
                                        <td>{{ $data->percentage }}</td>
                                        <td>Rp.{{$data->discount_nominal}}</td>
                                        <td>{{ $data->start_date }}</td>
                                        <td>{{ $data->end_date }}</td>
                                        <td>
                                            @if($data->status == '0')
                                                <span class="badge bg-danger">Tidak Aktif</span>
                                            @else
                                                <span class="badge bg-success">Aktif</span>
                                            
                                            @endif
                                        </td>
                                        <td>
                                            <a href="/discount/edit/{{ $data->id }}"><i class="bi bi-pencil-fill text-warning"></i></a>
                                            <form action="{{route('discount.delete', ['id' => $data->id])}}" method="POST" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <i data-bs-toggle="modal" data-bs-target="#confirmModal" class="bi bi-trash3-fill text-danger"></i>
                                                <div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                      <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Perhatian</h1>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus data ini?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
    </div>

@endsection
