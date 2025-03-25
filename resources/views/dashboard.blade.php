<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>





{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
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

        /* Hero Section */
        .hero {
            background: url('https://source.unsplash.com/1600x600/?nature,blog') center/cover no-repeat;
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
        }

        .hero h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }

        /* Blog Posts */
        .card {
            border: none;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card img {
            height: 200px;
            object-fit: cover;
        }

        /* Footer */
        .footer {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: white;
            padding: 20px;
            margin-top: 20px;
        }

    </style>
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
                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero">
        <div class="container text-center">
            <h1>Welcome to My Blog</h1>
            <p>Read amazing articles on various topics</p>
        </div>
    </header>

    <!-- Blog Posts -->
    <section class="container my-5">
        <h2 class="text-center mb-4">Latest Posts</h2>
        <div class="row" id="blog-posts">
            <!-- Blog posts will be inserted dynamically -->
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container text-center">
            <p>&copy; 2025 MyBlog. All rights reserved.</p>
        </div>
    </footer>


    <script>
        document.addEventListener("DOMContentLoaded", () => {
        const blogPosts = [
            {
                title: "Exploring the Mountains",
                content: "A thrilling experience in the high mountains.",
                image: "https://source.unsplash.com/400x300/?mountains,nature"
            },
            {
                title: "The Beauty of Sunsets",
                content: "A deep dive into the mesmerizing sunsets.",
                image: "https://source.unsplash.com/400x300/?sunset,nature"
            },
            {
                title: "Tech Innovations in 2025",
                content: "The future of technology and what to expect.",
                image: "https://source.unsplash.com/400x300/?technology,innovation"
            }
        ];

        const blogContainer = document.getElementById("blog-posts");

        blogPosts.forEach(post => {
            const postElement = `
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="${post.image}" class="card-img-top" alt="${post.title}">
                        <div class="card-body">
                            <h5 class="card-title">${post.title}</h5>
                            <p class="card-text">${post.content}</p>
                            <a href="#" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
            `;
            blogContainer.innerHTML += postElement;
        });
    });

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html> --}}

