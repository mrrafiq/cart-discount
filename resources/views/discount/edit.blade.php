@extends('layout.app')
@section('content')
<div class="container my-5">
    <div class="card">
        <div class="card-header">
            <h1>Tambah Produk</h1>
        </div>
        <div class="card-body">
            {{-- session flash --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{route('discount.update', ['id' => $data->id])}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="code" class="form-label">Kode Diskon</label>
                                    <input type="text" class="form-control" id="code" name="code" required value="{{$data->code}}">
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Diskon</label>
                                    <input type="text" class="form-control" id="name" name="name" required value="{{$data->name}}">
                                </div>
                                <div class="mb-3">
                                    <label for="discount_nominal" class="form-label">Nominal Diskon</label>
                                    <input type="number" class="form-control" id="discount_nominal" name="discount_nominal" placeholder="Nominal Diskon dalam rupiah" value="{{$data->discount_nominal}}">
                                </div>
                                <div class="mb-3">
                                    <label for="percentage" class="form-label">Persen Diskon</label>
                                    <input type="number" class="form-control" id="percentage" name="percentage" placeholder="Persen Diskon" value="{{$data->percentage}}">
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="start_date" class="form-label">Tanggal Mulai</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{$data->start_date}}">
                                    </div>
                                    <div class="col">
                                        <label for="end_date" class="form-label">Tanggal Berakhir</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{$data->end_date}}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="start_time" class="form-label">Waktu Mulai</label>
                                        <input type="time" class="form-control" id="start_time" name="start_time" value="{{$data->start_time}}">
                                    </div>
                                    <div class="col">
                                        <label for="end_time" class="form-label">Waktu Berakhir</label>
                                        <input type="time" class="form-control" id="end_time" name="end_time" value="{{$data->end_time}}">
                                    </div>
                                </div>
                                <label for="day_only" class="form-label">Hari Khusus</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-text">
                                        <input id="is_day_only" class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                                    </div>
                                    <select name="day_only" id="day_only" class="form-select" disabled>
                                        {{-- Nama hari --}}
                                        <option value="0">Pilih Hari</option>
                                        <option value="1" {{$data->day_only == '1' ? 'selected' : ''}}>Senin</option>
                                        <option value="2" {{$data->day_only == '2' ? 'selected' : ''}}>Selasa</option>
                                        <option value="3" {{$data->day_only == '3' ? 'selected' : ''}}>Rabu</option>
                                        <option value="4" {{$data->day_only == '4' ? 'selected' : ''}}>Kamis</option>
                                        <option value="5" {{$data->day_only == '5' ? 'selected' : ''}}>Jumat</option>
                                        <option value="6" {{$data->day_only == '6' ? 'selected' : ''}}>Sabtu</option>
                                        <option value="7" {{$data->day_only == '7' ? 'selected' : ''}}>Minggu</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="min_transaction" class="form-label">Minimal Transaksi</label>
                                    <input type="number" class="form-control" id="min_transaction" name="min_transaction" placeholder="Minimal transaksi dalam rupiah" value="{{$data->min_transaction}}">
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-select">
                                        <option selected>Pilih Status</option>
                                        <option value="1" {{$data->status == '1' ? 'selected' : ''}}>Aktif</option>
                                        <option value="0" {{$data->status == '2' ? 'selected' : ''}}>Tidak Aktif</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="description" name="description">{{$data->description}}</textarea>
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
<script>
    // If "is_day_only" is checked, then "day_only" will disabled
    const isDayOnly = document.getElementById('is_day_only');
    const dayOnly = document.getElementById('day_only');
    const dayOnly_val = dayOnly.value;
    const startDate = document.getElementById('start_date');
    const startDate_val = startDate.value;
    const endDate = document.getElementById('end_date');
    const endDate_val = endDate.value;

    isDayOnly.addEventListener('change', function() {
        if (isDayOnly.checked) {
            dayOnly.disabled = false;
            dayOnly.value = dayOnly_val;
            startDate.disabled = true;
            startDate.value = null;
            endDate.disabled = true;
            endDate.value = null;
        } else {
            dayOnly.disabled = true;
            dayOnly.value = "0";
            startDate.disabled = false;
            startDate.value = startDate_val;
            endDate.disabled = false;
            endDate.value = endDate_val;
        }
    });
    if (dayOnly.value != "0") {                
        isDayOnly.checked = true;
        dayOnly.disabled = false;
        
    }

    // if dayOnly has a value, then startDate and endDate will disabled and set to null
    dayOnly.addEventListener('change', function() {
        if (dayOnly.value != null && isDayOnly.checked) {
            startDate.disabled = true;
            startDate.value = null;
            endDate.disabled = true;
            endDate.value = null;
        } else {
            startDate.disabled = false;
            endDate.disabled = false;
        }
    });

    // when page is loaded, if dayOnly has a value, then startDate and endDate will disabled and set to null
    if (dayOnly.value != "0") {
        startDate.disabled = true;
        startDate.value = null;
        endDate.disabled = true;
        endDate.value = null;
    }
</script>
@endsection