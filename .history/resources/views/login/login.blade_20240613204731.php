@extends('layouts.main')

@section('content')
<div class="p-3 mb-2 bg-primary text-white">
    <div class="container-fluid">
        <div class="container" style="height: 72vh">
            <br>
            <div class="row mt-5 text-center mb-5">
                {{-- Alert --}}
                <div class="col-lg-4 offset-lg-4 mb-3">
                    @if(session()->has('success'))
                    <div class="alert alert-primary" role="alert">
                        <strong><small>{{ session('success') }}</small></strong>
                    </div>
                    @endif
                </div>
                {{-- End alert --}}
                <div class="col-lg-4 offset-lg-4">
                    <img src="img/pngwing.com (7).png" width="200" alt="">
                    <h3>Sign in to SIFOLIS</h3>
                </div>
                <div class="col-lg-4 offset-lg-4 col-10 offset-1 mt-3">
                    {{-- Form Login --}}
                    <div class="container">
                        <div class="card">
                            <div class="card-body">
                                <form action="/login" method="post">
                                    @csrf
                                    <div class="mb-1">
                                        <input type="text" id="username" name="username" placeholder="Username..." value="{{ old('username') }}" class="form-control @error('username') is-invalid @enderror">
                                        @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mb-1">
                                        <input type="password" id="password" name="password" placeholder="Password..." value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror">
                                        @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mb-2 text-start">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                <p class="text-primary"> <small>Show in password<small></p>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <button class="btn btn-outline-primary w-100" type="submit">LOGIN</button>
                                    </div>
                                    <h3>
                                        <div class="sosmed d-flex justify-content-center gap-3">
                                            <a href="https://myaccount.google.com/?utm_source=sign_in_no_continue&pli=1"><i class="fa-brands fa-google fa-sm "></i></a>
                                            <a href="https://www.facebook.com/"><i class="fa-brands fa-square-facebook fa-sm"></i></a>
                                        </div>
                                    </h3>

                                    <div>
                                        <p class="text-primary"><small>don't have an account yet?</small></p>
                                        <p><a href="registrasi" class="text-decoration-none">register now</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                        {{-- End Form --}}
                    </div>
                </div>

            </div>
        </div>
    </div>
    <br><br><br>


@if(session('error'))
<script>
    Swal.fire({
        title: 'Error!',
        text: "{{ session('error') }}",
        icon: 'error',
        confirmButtonText: 'Ok'
    });
</script>
@endif
<!-- End Sweet Alert -->

@endsection
