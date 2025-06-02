<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Nest - Connect with Friends</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
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
    <div class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="brand-logo">Social Nest</div>
                    <p class="hero-text">Connect with friends and the world around you on Social Nest.</p>
                </div>
                <div class="col-lg-6">
                    <div class="card p-4">
                        <form>
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="Email or phone number">
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary">Log In</button>
                            </div>
                            <div class="text-center mb-3">
                                <a href="#" class="text-decoration-none">Forgot password?</a>
                            </div>
                            <hr>
                            <div class="d-grid">
                                <button type="button" class="btn btn-success">Create New Account</button>
                            </div>
                        </form>
                    </div>
                    <div class="text-center mt-4">
                        <p class="small"><a href="#" class="text-decoration-none fw-bold">Create a Page</a> for a celebrity, brand or business.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Custom JS -->
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
</body>
</html>
