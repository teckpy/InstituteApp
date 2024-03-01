<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('Admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('Admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('Admin/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="" class="h1"><b>GSS</b>COACHING</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Register a new membership</p>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h1
                            class="text-3xl md:text-5xl font-extrabold text-center uppercase mb-12 bg-gradient-to-r from-indigo-400 via-purple-500 to-indigo-600 bg-clip-text text-transparent transform -rotate-2">
                            Razorpay Payment Gateway</h1>
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif

                            <form action="{{ route('razorpay.make.payment') }}" method="POST">
                                @csrf
                                <script src="https://checkout.razorpay.com/v1/checkout.js"
                                data-key="{{ env('RAZORPAY_API_KEY') }}"
                                data-amount="100"
                                data-buttontext="Pay 100 INR"
                                data-name="Laravelia"
                                data-description="A demo razorpay payment"
                                data-image="https://www.laravelia.com/storage/logo.png"
                                data-prefill.name="Mahedi Hasan"
                                data-prefill.email="mahedy150101@gmail.com"
                                data-theme.color="#ff7529">
                        </script>
                            </form>

                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- jQuery -->
    <script src="{{ asset('Admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('Admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('Admin/dist/js/adminlte.min.js') }}"></script>
</body>

</html>
