@extends('layout.app')
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12">
                <h1>Keranjang</h1>
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
                        {{-- list of cart --}}
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                    <th>Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($datas) === 0)
                                    <tr>
                                        <td colspan="6" class="text-center">Keranjang Kosong</td>
                                    </tr>
                                @endif
                                @foreach ($datas as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->product->name }}</td>
                                        <td>Rp.{{ $data->product->price }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic outlined example">
                                                <button type="button" class="btn btn-outline-success" id="btn-minus_{{$data->id}}">-</button>
                                                <input type="text" class="form-control text-center form-control-sm" id="quantity_{{$data->id}}" name="quantity_{{$data->id}}" value="{{$data->quantity}}">
                                                <button type="button" class="btn btn-outline-success" id="btn-plus_{{$data->id}}">+</button>
                                            </div>
                                        </td>
                                        <td>Rp.<span id="subtotal_{{$data->id}}">{{ $data->total_price }}</span></td>
                                        <td>
                                            <form action="{{route('cart.delete', ['id' => $data->id])}}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#confirmModal" class="btn btn-link btn-sm text-danger"><i class="bi bi-trash3-fill"></i></button>
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
                                {{-- gunakan kupon --}}
                                <tr>
                                    <td colspan="5" class="text-end">
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#discountModal" class="btn btn-sm btn-outline-success"><span><i class="bi bi-percent"></i></span>Gunakan Kode Diskon/Reward</button>
                                    </td>
                                    <td><span class="fw-bold text-success">{{$cart_discount->discount->code ?? ""}}</span></td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-end">Total: </td>
                                    <td><span id="total"></span></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-end">Potongan: </td>
                                    <td><span id="discount">0</span></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-end text-success">Harga Setelah Diskon: </td>
                                    <td><span id="after_discount" class="fw-bold"></span></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="modal fade" id="discountModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Kode Diskon</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('discount.use')}}" method="POST">
                                        @csrf
                                        <input type="hidden" id="total_price" name="total_price" value="0">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control" id="discount_code" name="discount_code" placeholder="Masukkan kode diskon" value="{{$cart_discount->discount->code ?? ''}}">
                                            </div>
                                            <div class="col">
                                                <button type="submit" class="btn btn-success">Gunakan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-light" data-bs-dismiss="modal">Urungkan</button>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between">
                    <div class="col-4"></div>
                    <div class="col-4 text-end">
                        <form action="{{route('order.store')}}" method="POST">
                            @csrf
                            <div class="d-grid">
                                <input type="hidden" name="price_before" id="price_before" value="">
                                <input type="hidden" name="price_after" id="price_after" value="">
                                <input type="hidden" name="discount_id" id="discount_id" value="{{$cart_discount->discount->id ?? null}}">
                                <button type="submit" class="btn btn-success">Order</button>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let afterDiscount = document.getElementById('after_discount');
        let totalPrice = document.getElementById('total_price');
        const discount_percentage = {{$cart_discount->discount->percentage ?? 0}}
        const discount_nominal = {{$cart_discount->discount->discount_nominal ?? 0}}
        const discount_code = document.getElementById('discount_code')
        

        // when page is ready, set total value
        document.addEventListener('DOMContentLoaded', function(){
            calculate();
            
        });

        // make quantity input number works on each row of cart
        @foreach ($datas as $data)
            document.getElementById('btn-minus_{{$data->id}}').addEventListener('click', function(){
                let quantity = document.getElementById('quantity_{{$data->id}}');
                let subtotal = document.getElementById('subtotal_{{$data->id}}');
                let total = document.getElementById('total');
                let price = {{$data->product->price}};
                let qty = parseInt(quantity.value);
                if (discount_code.value != '') {
                    alert('Batalkan penggunakan kode diskon terlebih dahulu')
                }
                else if(qty > 1){
                    qty -= 1;
                    quantity.value = qty;
                    subtotal.innerHTML = qty * price;
                    // total.innerHTML = parseInt(total.innerHTML) - price;
                    calculate();
                    
                }
                $.ajax({
                    url: "http://127.0.0.1:8000/api/cart/adjust-qty/{{$data->id}}",
                    type: "POST",
                    contentType: "application/x-www-form-urlencoded",
                    data: {
                        quantity: qty,
                        
                    },
                    success: function (msg) {
                        alert(msg.message);
                        
                    },
                    error: function (err) {
                        alert(err.message)
                    }
                });
                
            });
            document.getElementById('btn-plus_{{$data->id}}').addEventListener('click', function(){
                let quantity = document.getElementById('quantity_{{$data->id}}');
                let subtotal = document.getElementById('subtotal_{{$data->id}}');
                let total = document.getElementById('total');
                let price = {{$data->product->price}};
                let qty = parseInt(quantity.value);
                if (discount_code.value != '') {
                    alert('Batalkan penggunakan kode diskon terlebih dahulu')
                }else{
                    qty += 1;
                    quantity.value = qty;
                    subtotal.innerHTML = qty * price;
                    // total.innerHTML = total.innerHTML + price;
                    calculate();

                    $.ajax({
                        url: "http://127.0.0.1:8000/api/cart/adjust-qty/{{$data->id}}",
                        type: "POST",
                        contentType: "application/x-www-form-urlencoded",
                        data: {
                            quantity: qty,
                            
                        },
                        success: function (msg) {
                            alert(msg.message);
                            
                        },
                        error: function (err) {
                            alert(err.message)
                        }
                    });
                }

               

            });
        @endforeach

        // calculate subtotal
        function calculate(){
            const subtotals = document.querySelectorAll('[id^=subtotal]');
            let total = 0;
            let discount = 0;
            subtotals.forEach(subtotal => {
                total += parseInt(subtotal.innerText);
            });
            document.getElementById('total').innerText = total;
            totalPrice.value = total;
            
            // subtract total with discount percentage
            if (discount_percentage != null || discount_percentage != 0) {
                discount += (discount_percentage/100) * total
                total -= discount
            }

            // subtract total_price with discount nominal
            if(discount_nominal != null || discount_nominal != 0){
                total -= discount_nominal;
            }

            // set discount value
            document.getElementById('discount').innerText = discount + discount_nominal            

            // set after discount value
            afterDiscount.innerHTML = total.toFixed(2)

            document.getElementById('price_after').value = afterDiscount.innerHTML
            document.getElementById('price_before').value = document.getElementById('total').innerText

        }
    </script>
@endsection