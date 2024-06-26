@extends('dashboard.layouts.main')

@section('content')

<div class="container">

    <div class="row py-3">
        <div class="col-lg-12">
            <h3>{{ $title }}</h3>
        </div>
    </div>

    {{-- Form Tambah --}}
    <div class="row mb-3">
        <div class="col-lg-8">
            <form action="/sarana-prasarana/{{ $barang->id }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <input type="hidden" name="gambarLama" value="{{ $barang->image }}">

                <div class="mb-2">
                    <label for="category_id" class="form-label">Category</label>
                    <select class="form-select" name="category_id">
                        <option selected value="{{ $barang->category->id }}">{{ $barang->category->category }}</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category }}</option>
                        @endforeach
                      </select>
                </div>

                <div class="mb-2">
                    <label for="nama_barang" class="form-label">Sarana Prasarana</label>
                    <input type="text" id="nama_barang" name="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror" value="{{ old('nama_barang', $barang->nama_barang) }}">
                    @error('nama_barang')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="number" id="stok" name="stok" class="form-control @error('stok') is-invalid @enderror" value="{{ old('stok', $barang->stok) }}">
                    @error('stok')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    @if($barang->image)
                    <img src="{{ asset('storage/' . $barang->image) }}" alt="" class="col-lg-3 img-preview img-fluid d-block mb-2">
                    @else
                    <img class="img-preview col-lg-3 col-3 mb-2 img-fluid">
                    @endif
                    <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror" onchange="previewImage()">
                    @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-2">
                    <button type="submit" class="btn btn-outline-primary btn-sm w-50">Submit</button>
                    <button class="btn btn-outline-danger btn-sm" type="reset">Reset</button>
                </div>

            </form>
        </div>
    </div>
    {{-- End Form --}}

</div>

@endsection
