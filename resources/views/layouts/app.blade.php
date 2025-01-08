<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SAFA SHOP - Art de la Table</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #000;
            --secondary-color: #666;
            --border-color: #e0e0e0;
        }

        body {
            font-family: Arial, sans-serif;
            color: var(--primary-color);
        }

        .navbar {
            padding: 1rem 0;
            border-bottom: 1px solid var(--border-color);
        }

        .navbar-brand {
            font-size: 2rem;
            font-weight: bold;
            color: var(--primary-color) !important;
        }

        .nav-link {
            color: var(--primary-color) !important;
            font-size: 1rem;
            margin: 0 1rem;
        }

        .product-card {
            border: none;
            margin-bottom: 1rem;
            display: flex;
            align-items: flex-start;
            padding: 1.5rem;
            background-color: #fff;
            border-bottom: 1px solid var(--border-color);
            width: 100%;
        }

        .product-image {
            width: 120px;
            height: auto;
            margin-right: 2rem;
            object-fit: contain;
        }

        .product-details {
            flex-grow: 1;
            margin-right: 2rem;
        }

        .product-title {
            font-size: 1rem;
            color: var(--primary-color);
            margin-bottom: 0.25rem;
            font-weight: normal;
        }

        .product-subtitle {
            color: var(--secondary-color);
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .product-price {
            font-size: 1rem;
            color: var(--primary-color);
            margin-left: auto;
            white-space: nowrap;
        }

        .quantity-control {
            display: inline-flex;
            align-items: center;
            border: 1px solid var(--border-color);
            margin-right: 1rem;
            height: 40px;
        }

        .quantity-btn {
            background: none;
            border: none;
            padding: 0 1rem;
            font-size: 1.2rem;
            cursor: pointer;
            color: var(--secondary-color);
            height: 100%;
        }

        .quantity-input {
            width: 40px;
            text-align: center;
            border: none;
            border-left: 1px solid var(--border-color);
            border-right: 1px solid var(--border-color);
            padding: 0.5rem;
            margin: 0;
            height: 100%;
        }

        .remove-btn {
            background: none;
            border: none;
            color: var(--secondary-color);
            text-decoration: underline;
            cursor: pointer;
            padding: 0;
            font-size: 0.9rem;
        }

        .add-btn {
            display: none;
        }

        .product-card.removed .remove-btn {
            display: none;
        }

        .product-card.removed .add-btn {
            display: inline;
        }

        .product-card.removed .quantity-control {
            opacity: 0.5;
            pointer-events: none;
        }

        .cart-section {
            background-color: #f8f8f8;
            padding: 2rem;
        }

        .cart-title {
            font-size: 1.5rem;
            margin-bottom: 2rem;
        }

        .cart-item {
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        .subtotal-row {
            display: flex;
            justify-content: space-between;
            margin: 1rem 0;
            font-size: 1.1rem;
        }

        .checkout-btn {
            width: 100%;
            padding: 1rem;
            background-color: var(--primary-color);
            color: white;
            border: none;
            margin-top: 1rem;
            font-size: 1.1rem;
        }

        .product-checkbox {
            position: absolute;
            top: 1rem;
            right: 1rem;
            transform: scale(1.5);
        }

        footer {
            background-color: #f8f8f8;
            padding: 3rem 0;
            margin-top: 4rem;
        }

        .cart-btn {
            background: none;
            border: none;
            color: var(--secondary-color);
            text-decoration: underline;
            cursor: pointer;
            padding: 0;
            font-size: 0.9rem;
        }

        .product-card.in-cart .cart-btn[data-action="add"] {
            display: none;
        }

        .product-card:not(.in-cart) .cart-btn[data-action="remove"] {
            display: none;
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">SAFA SHOP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('orders.index') }}">Orders</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <a href="#" class="nav-link">
                        <i class="fas fa-search"></i>
                    </a>
                    <a href="#" class="nav-link">
                        <i class="fas fa-user"></i>
                    </a>
                    <a href="#" class="nav-link">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

    <footer class="footer mt-5 py-3 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h5>About SAFA SHOP</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-dark">Our Story</a></li>
                        <li><a href="#" class="text-dark">Sustainability</a></li>
                        <li><a href="#" class="text-dark">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Customer Service</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-dark">Delivery Information</a></li>
                        <li><a href="#" class="text-dark">Returns Policy</a></li>
                        <li><a href="#" class="text-dark">FAQ</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Legal</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-dark">Privacy Policy</a></li>
                        <li><a href="#" class="text-dark">Terms & Conditions</a></li>
                        <li><a href="#" class="text-dark">Cookie Policy</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Follow Us</h5>
                    <div class="social-links">
                        <a href="#" class="text-dark me-2"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-dark me-2"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-dark me-2"><i class="fab fa-pinterest"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    @stack('scripts')
</body>
</html>
