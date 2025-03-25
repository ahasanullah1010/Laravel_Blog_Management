
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<style>
    /* Global Styles */
    body {
        font-family: 'Arial', sans-serif;
        background: #f4f4f4;
    }


    /* Navbar */
    .navbar {
        background: linear-gradient(135deg, #6a11cb, #2575fc);
    }

    .navbar-brand {
        font-size: 1.8rem;
        font-weight: bold;
        color: white;
    }

    .navbar-brand span {
        color: #ffcc00;
    }

    .navbar-nav .nav-link {
        color: white;
        font-weight: 500;
        margin-left: 10px;
    }

    .navbar-nav .nav-link:hover {
        color: #ffcc00;
    }

</style>
    
        @yield("style")
    
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">My<span>Blog</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="{{ url('/home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#blogs">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                    @if (Auth::check() && Auth::user()->hasRole('admin'))
                        <li class="nav-item"><a class="nav-link" href="/admin/post/handle">Admin Pannel</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero">
        @yield("header")
    </header>

    <!-- Blog Posts -->
    <section id="blogs" class="container  my-5">
        @yield("content")
        @yield("blogs")
    </section>

    <!-- Footer -->
    <footer class="footer">
        @yield("footer")
    </footer>


    
        @yield("script")

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
