@extends('layouts.main')

@section('content')

<main class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $product->nama_barang }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ asset('/img/') }}/{{ $product->gambar }}" class="rounded mx-auto d-block" width="100%" alt="">
                        </div>
                        <div class="col-md-6">
                            <h3></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection