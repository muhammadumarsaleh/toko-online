@extends('layouts.main')

@section('content')

<main class="container">

<div class="row justify-content-center">
  <div class="col-md-12 mb-5 mt-4">
      <img src="{{ asset('/img/logo.png') }}" class="rounded mx-auto d-block" width="650">
  </div>
    @foreach($products as $product)
    <div class="col md-4">
      <div class="card" style="width: 21rem;">
        <img src="{{ asset('img/') }}/{{ $product->gambar }}" class="card-img-top" width="100" height="290" alt="...">
        <div class="card-body">
          <h5 class="card-title">{{ $product->nama_barang }}</h5>
          <p class="card-text">
            <strong>Harga :</strong>Rp. {{ number_format($product->harga) }} <br>
            <strong>Stok :</strong> {{ $product->stok }} <br>
            <hr>
            <strong>Keterangan</strong> <br>
            {{ $product->keterangan }}
          </p>
          <a href="/order/{{ $product->id }}" class="btn btn-primary"><i class="fa-solid fa-cart-plus"></i>Pesan</a>
        </div>
      </div>
    </div>
    @endforeach
</div>


{{-- <div class="my-3 p-3 bg-body rounded shadow-sm">
<div class="d-flex text-muted pt-3">
    </div>
  </div> --}}

</main>

@endsection