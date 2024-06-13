<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    {{-- Styel Css Home --}}
    <link rel="stylesheet" href="/css/style.css">

    {{-- Link Icons Bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    {{-- Link Animtion Aos --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

</head>

<body>

    @include('navbar.navbar')

    <div class="container-fluid bg-primary bg-gradient" id="container-fluid">
        <div class="container1">

            <div class="row py-3 text-center">
                <div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-sm-8 offset-sm-2 col-12 ">
                    @if (session()->has('success'))
                        {{-- Alert --}}
                        <div class="alert alert-success" role="alert">
                            <strong>{{ session('success') }}</strong>
                        </div>
                        {{-- End alert --}}
                    @endif
                </div>
            </div>

            <div class="row py-3 text-center text-white">
                <div class="col-lg-12">
                    <h2>SIFOLIS</h2>
                    <h3>Sistem Informasi Logistik</h3>
                </div>
            </div>
            <div class="row text-white text-center d-flex justify-content-center ">
                <div class="col-lg-8">
                    <img  data-aos="flip-left" data-aos-duration="1000" src="img/pngwing.com (7).png" width="150px" alt="" style="align-items: center">
                    <h1>Peminjaman Barang dan Ruangan<h1>
                            <n>Sistem Informasi Logistik Telkom University
                        </h1>
                        </n>
                </div>
            </div>

            <div class="row py-3 text-center mt-5" >
                <div class="col-lg-12">
                    <a href="sarana dan prasarana" class="btn btn-light ">Sarana dan Prasarana</a>
                </div>
            </div><br><br><br><br><br><br>

        </div>
    </div>

    @include('footer.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>

    {{-- Link Jquery --}}
    <script src="js/jquery.js"></script>

    {{-- Link Script Js --}}
    <script src="js/script.js"></script>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>


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
        title: 'TES'
    });
</script>
@endif
</body>

</html>
