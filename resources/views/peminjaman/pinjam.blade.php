@extends('layouts.main')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="container">

    @if(session()->has('success'))
    <div class="row mt-5">
        <div class="col-lg-6 offset-lg-3">
            {{-- Alert --}}
            <div class="alert alert-primary" role="alert">
               <small><strong>{{ session('success') }}</strong></small>
              </div>
            {{-- End Alert --}}
        </div>
    </div>
    @endif

    <div class="row py-5">
        <div class="col-lg-8 offset-lg-2">
            <div class="card mb-3">
                <a href="{{ asset('storage/' . str_replace('public/', '', $barang->image)) }}" target="_blank">
                    <img src="{{ asset('storage/' . str_replace('public/', '', $barang->image)) }}" width="150px"
                        title="{{ $barang->nama_barang }}">
                </a>
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-8">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <tbody>
                                    <tr>
                                        <td><strong>Nama Barang</strong></td>
                                        <td><strong>:</strong></td>
                                        <td>{{ $title }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Stok</strong></td>
                                        <td><strong>:</strong></td>
                                        <td>{{ $barang->stok }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Catgeory</strong></td>
                                        <td><strong>:</strong></td>
                                        <td>{{ $barang->category->category }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Jumlah Pinjaman</strong></td>
                                        <td><strong>:</strong></td>
                                        <form action="/peminjaman/{{ $barang->id }}" method="post">
                                            @csrf
                                        <td><input type="number" name="jumlahPinjaman" class="form-control @error('jumlahPinjaman') is-ivalid @enderror" required>
                                            @error('jumlahPinjaman')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                          </div>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Yakin ingin meminjam?')">Pinjam Sekarang</button>
                </form>
                {{-- End Form --}}
                </div>
              </div>
        </div>
    </div>

</div>


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
@endsection


