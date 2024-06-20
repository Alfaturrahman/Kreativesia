<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PsychoSpace</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('web-assets/css/login.css') }}">
    @laravelPWA
</head>
<body class="min-vh-100 header finisher-header">
    <a href="/login" class="btn m-3">
        <i class="fa-solid fa-arrow-left"></i> kembali
    </a>
    <div class="container-login d-flex justify-content-center align-items-center">
        <div class="login-form card">
            <img src="{{ asset('web-assets/image/logo-icon.png') }}" alt="" class="img-fluid object-fit-cover mb-3">
            <h4 class="text-center mb-3">Lupa kata sandi?</h4>
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukan email Anda" value="{{ old('email') }}" required autofocus>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn">Kirim Email</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('web-assets/js/finisher-header.es5.min.js') }}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>

    @if (session('notifikasi'))
    <script>
        Swal.fire({
            text: '{{ session('notifikasi') }}',
            icon: '{{ session('type') }}',
            confirmButtonText:'OK',
            showCloseButton: true,
            timer: 2000,
        })
    </script>
    @endif
    <script type="text/javascript">
        new FinisherHeader({
            "count": 6,
            "size": {
                "min": 1100,
                "max": 1300,
                "pulse": 0
            },
            "speed": {
                "x": {
                "min": 0.1,
                "max": 0.3
                },
                "y": {
                "min": 0.1,
                "max": 0.3
                }
            },
            "colors": {
                "background": "#ffebeb",
                "particles": [
                "#c98f8f",
                "#e7c7c6"
                ]
            },
            "blending": "screen",
            "opacity": {
                "center": 1,
                "edge": 0.1
            },
            "skew": 0,
            "shapes": [
                "c"
            ]
        });
    </script>
</body>
</html>
