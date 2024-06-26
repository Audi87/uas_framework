@extends('layouts.main')

@section('content')

<div class="regis p-3 mb-2 bg-primary text-white">
    <div class="container-fluid py-5">
        <div class="row text-center mb-5">
            <div class="col-lg-4 offset-lg-4" >
                <h2>
                    <img src="img/pngwing.com (7).png" text-primary width="50" alt="" data-aos="flip-left" data-aos-duration="2000" >
                    Sign Up
                </h2>
            </div>
            <div class="col-lg-4 offset-lg-4 col-10 offset-1 mt-3">
                {{-- Form Registrasi --}}
                <div class="card">
                    <div class="card-body">
                        <form action="/registrasi" method="post">
                            @csrf
                            <div class="mb-10">
                                <input type="text" id="name" name="name" placeholder="Name..." value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <input type="text" id="username" name="username" placeholder="Username..." value="{{ old('username') }}" class="form-control @error('username') is-invalid @enderror">
                                @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <input type="text" id="alamat" name="alamat" placeholder="Alamat..." value="{{ old('alamat') }}" class="form-control @error('alamat') is-invalid @enderror">
                                @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <input type="number" id="no_handphone" name="no_handphone" placeholder="No. Handphone..." value="{{ old('no_handphone') }}" class="form-control @error('no_handphone') is-invalid @enderror">
                                @error('no_handphone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <input type="email" id="email" name="email" placeholder="Email..." value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <input type="password" id="password" name="password" placeholder="Password..." value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <button class="btn btn-outline-primary w-100" type="submit">REGISTRASTION</button>
                            </div>
                            <div>
                                <p><small>already have an account? <a href="login" class="text-decoration-none">Login</a></small></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
<script>
    Swal.fire({
        title: 'Registrasi Berhasil!',
        text: "{{ session('success') }}",
        icon: 'success',
        confirmButtonText: 'Ok'
    });
</script>
@endif

@endsection
