@extends('layouts.main')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="container-fluid">
    <div class="container">

        <div class="row mt-3 py-3">
            <div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-8 offset-sm-2 col-12">
                {{-- Form Search --}}
                <form action="" method="get">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari Sarana / Prasarana" name="search"
                            value="{{ request('search') }}" autofocus>
                        <button class="btn btn-outline-primary" type="submit" id="button-addon2">Cari</button>
                    </div>
                </form>
                {{-- End Form --}}
            </div>
        </div>

        {{-- Jika ada pencarian --}}
        @if (request('search'))
        <div class="row mb-3 text-center mb-3">
            <div class="col-lg-12">
                @if ($barangs->count() > 0)
                <p class="text-success">Pencarian Sarana atau Prasarana <strong
                        style="font-style: italic">"{{ request('search') }}"</strong> ditemukan!</p>
                @else
                <p class="text-danger">Pencarian Sarana atau Prasarana <strong
                        style="font-style: italic">"{{ request('search') }}"</strong> tidak ditemukan!</p>
                @endif
            </div>
        </div>
        @endif
        {{-- End pencarian --}}

        <div class="row mb-3 text-center text-white gx-1">
            @foreach ($categories as $category)
            <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                <a href="/category/{{ $category->id }}" class="text-decoration-none text-white">
                    <div class="card bg-primary bg-gradient p-2">
                        <h3>{{ $category->category }}</h3>
                    </div>
                </a>
            </div>
            @endforeach
        </div>

        <div class="row text-center mb-3">
            <div class="col-lg-12">
                <h3>{{ $title }}</h3>
            </div>
        </div>

        {{-- Sarana dan prasana --}}
        @if ($barangs->count() > 0)
        <div class="row mb-3 gx-1">
            @foreach ($barangs as $barang)
            <div class="col-lg-4 mb-2">
                <div class="card p-3 text-center" style="height: 100%;">

                    <a href="{{ asset('storage/' . str_replace('public/', '', $barang->image)) }}" target="_blank">
                        <div class="img-container">
                            <img src="{{ asset('storage/' . str_replace('public/', '', $barang->image)) }}" class="card-img-top img-ratio" alt="{{ $barang->nama_barang }}">
                        </div>
                    </a>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $barang->nama_barang }}</h5>
                        <p class="card-text"><strong>Stok : </strong>{{ $barang->stok }}</p>
                        <p class="card-text"><strong>Category : </strong>{{ $barang->category->category }}</p>
                        <a href="/peminjaman/{{ $barang->id }}" class="btn btn-primary btn-sm mt-auto">Pinjam</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        {{-- <div class="row text-center text-danger">
            <div class="row mb-3">
                <h4>Sarana / Prasarana <strong style="font-style: italic">"{{ request('search') }}"</strong> Tidak
                    Ada!</h4>
            </div>
        </div> --}}
        @endif

        {{-- End sarana dan prasarana --}}

    </div>
</div>

@endsection

<style>
    .img-container {
        width: 100%;
        padding-top: 100%; /* 1:1 Aspect Ratio */
        position: relative;
    }
    .img-ratio {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>


@if ($message = Session::get('success'))
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    Toast.fire({
        icon: "success",
        title: 'Sip'
    });
</script>
@endif
