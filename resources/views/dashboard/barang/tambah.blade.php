@extends('dashboard.layouts.main')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="sweetalert2.all.min.js"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<div class="container">

    <div class="row py-3">
        <div class="col-lg-12">
            <h3>{{ $title }}</h3>
        </div>
    </div>

    {{-- Form Tambah --}}
    <div class="row mb-3">
        <div class="col-lg-8">
            <form action="/sarana-prasarana" method="post" enctype="multipart/form-data">
                @csrf

                <div class="mb-2">
                    <label for="category_id" class="form-label">Category</label>
                    <select class="form-select" name="category_id">
                        <option selected>---Pilih---</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-2">
                    <label for="nama_barang" class="form-label">Fasilitas</label>
                    <input type="text" id="nama_barang" name="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror" value="{{ old('nama_barang') }}">
                    @error('nama_barang')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="number" id="stok" name="stok" class="form-control @error('stok') is-invalid @enderror" value="{{ old('stok') }}">
                    @error('stok')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <img class="img-preview col-lg-3 mb-2 img-fluid">
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

{{-- gawe notif gagal --}}
@if ($message = Session::get('gagal'))
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
    Toast.fire({
        icon: "error",
        title: '{{ $message }}'
    });
</script>
@endif
{{-- gawe notif sukses --}}
@if ($message = Session::get('success'))
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
    Toast.fire({
        icon: "success",
        title: '{{ $message }}'
    });
</script>
@endif
@endsection

<script>
    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        };
    }
</script>
