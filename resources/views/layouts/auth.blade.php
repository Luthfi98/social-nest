


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Nest - Connect with Friends</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #1877f2;
            --secondary-color: #42b72a;
            --dark-color: #1c1e21;
            --light-color: #f0f2f5;
        }
        body {
            background-color: var(--light-color);
            font-family: Helvetica, Arial, sans-serif;
        }
        .hero-section {
            min-height: 100vh;
            padding: 80px 0;
        }
        .brand-logo {
            color: var(--primary-color);
            font-size: 3.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        .hero-text {
            font-size: 1.5rem;
            color: var(--dark-color);
            margin-bottom: 2rem;
        }
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.5rem 2rem;
            font-size: 1.2rem;
        }
        .btn-success {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            padding: 0.5rem 2rem;
            font-size: 1.2rem;
        }
        .card {
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .form-control {
            padding: 0.8rem;
            font-size: 1rem;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(24, 119, 242, 0.25);
        }
    </style>
</head>
<body>
    @yield('content')

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Custom JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>
    <script>
        $(document).ready(function() {
            // Add smooth scrolling
            $('a[href*="#"]').on('click', function(e) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: $($(this).attr('href')).offset().top
                }, 500, 'linear');
            });
        });
    </script>
     @if (session()->has('error'))
        <script>
            toastr.error("{{ session('error') }}");
        </script>
    @endif

    @if (session()->has('success'))
        <script>
            toastr.success("{{ session('success') }}");
        </script>
    @endif

</body>
</html>
