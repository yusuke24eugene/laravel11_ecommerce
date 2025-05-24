@props([
    'value' => '',
    'usertype' => '',
    'categories' => ['Men', 'Women', 'Kids'],
    'count' => 0,
    'orders' => 0,
])

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>{{ config('app.name', 'E-COMMERCE') }}</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="/styles.css">
</head>

<body>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand text-light font-bold" href="{{ route('index') }}">E-COMMERCE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link nav-list {{ Route::is('index') ? 'active-link' : '' }}" aria-current="page"
                            href="{{ route('index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-list {{ Route::is('showProducts') ? 'active-link' : '' }}"
                            href="{{ route('showProducts') }}">Shop</a>
                    </li>
                    <li class="nav-item dropdown nav-list">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Products
                        </a>
                        <ul class="dropdown-menu">
                            @foreach ($categories as $category)
                                <li><a class="dropdown-item list-item"
                                        href="{{ url('searchByCategory', $category) }}">{{ $category }}</a></li>
                                @if ($category !== end($categories))
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                    @auth
                        @if ($usertype === 'admin')
                            <li class="nav-item">
                                <a class="nav-link nav-list" href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                        @elseif ($usertype === 'user')
                            <li class="nav-item">
                                <a class="nav-link nav-list {{ Route::is('cart') ? 'active-link' : '' }}"
                                    href="{{ route('cart') }}">Cart @if ($count > 0)
                                        <sup
                                            class="badge rounded-pill badge-notification bg-info">{{ $count }}</sup>
                                    @endif
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-list {{ Route::is('order') ? 'active-link' : '' }}"
                                    href="{{ route('order') }}">Order @if ($orders > 0)
                                        <sup
                                            class="badge rounded-pill badge-notification bg-info">{{ $orders }}</sup>
                                    @endif
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>
                <form id="form" class="mx-3 d-flex d-sm-none d-lg-flex" role="search"
                    action="{{ url('search') }}" method="get">
                    @csrf
                    <input id="input" class="form-control search-input" type="search" placeholder="Search"
                        aria-label="Search" name="search" value="{{ $value }}">
                    <button class="btn btn-info search-icon" type="submit"><i class="fas fa-search"></i></button>
                </form>
                @auth
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <div class="d-flex justify-content-center m-1">
                            <input type="submit" class="btn btn-primary m-2 d-flex" value="LOG OUT">
                        </div>
                    </form>
                @else
                    <div class="d-flex justify-content-center m-1">
                        <a class="btn btn-primary m-2" href="{{ route('login') }}">LOG IN</a>
                        <a class="btn btn-secondary m-2" href="{{ route('signup') }}">SIGN UP</a>
                    </div>
                @endauth

            </div>
        </div>
    </nav>

    <main class="py-5 px-4 mw-100-lg">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="text-center text-lg-start bg-body-tertiary text-muted">
        <!-- Section: Social media -->
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
            <!-- Left -->
            <div class="me-5 d-none d-lg-block">
                <span>Get connected with us on social networks:</span>
            </div>
            <!-- Left -->

            <!-- Right -->
            <div style="">
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-google"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-github"></i>
                </a>
            </div>
            <!-- Right -->
        </section>
        <!-- Section: Social media -->

        <!-- Section: Links  -->
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <!-- Content -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            <i class="fas fa-gem me-3"></i>E-COMMERCE
                        </h6>
                        <p>
                            Here you can use rows and columns to organize your footer content. Lorem ipsum
                            dolor sit amet, consectetur adipisicing elit.
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Products
                        </h6>
                        <p>
                            <a href="#!" class="text-reset">Clothes</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Electronics</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Toys</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Accessories</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Useful links
                        </h6>
                        <p>
                            <a href="#!" class="text-reset">Pricing</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Settings</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Orders</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Help</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                        <p><i class="fas fa-home me-3"></i> Manila, MNL 1004, PHL</p>
                        <p>
                            <i class="fas fa-envelope me-3"></i>
                            info@example.com
                        </p>
                        <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
                        <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p>
                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links  -->

        <!-- Copyright -->
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2024 Copyright:
            <a class="text-reset fw-bold" href="">E-COMMERCE</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->
</body>
<script src="{{ asset('preventSubmit.js') }}"></script>

</html>
