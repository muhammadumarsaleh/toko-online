@extends('layouts.main')

@section('content')

<main class="container">
    <div class="row">
        <div class="col-md-12 mt-3">
            <a href="/" class="btn btn-primary"><i class="fa fa-arrow-left"></i>Kembali</a>
        </div>
        <div class="col-md-12 mt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
              </nav>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3><i class="fa fa-shopping-cart"></i> Checkout</h3>
                    @if(!empty($order))
                    <p align="right" >Tanggal pesan : {{ $order->tanggal }}</p>
                      <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Nama Product</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($orderDetails as $orderDetail)                     
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>
                                    <img src="{{ asset('img') }}/{{ $orderDetail->product->gambar }}" width="90" alt="">
                                </td>
                                <td>{{ $orderDetail->product->nama_barang }}</td>
                                <td>{{ $orderDetail->jumlah }} kain</td>
                                <td align="left">Rp. {{ number_format($orderDetail->product->harga) }}</td>
                                <td align="left">Rp. {{ number_format($orderDetail->jumlah_harga) }}</td>
                                <td>
                                    <form action="/checkout/{{ $orderDetail->id }}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin akan menghapus data?');"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                                
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="5" align="right"><strong>Total Harga :</strong></td>
                                <td>Rp. {{ number_format($order->total_harga) }}</td>
                                <td>
                                    <a href="/checkout/confirm" class="btn btn-success" onclick="return confirm('Anda yakin akan checkout?');">
                                        <i class="fa fa-shopping-cart">Checkout</i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>

        </div>
    </div>
</main>   

@endsection