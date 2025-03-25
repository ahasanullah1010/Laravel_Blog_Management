
@extends('layout.app')

    @section('style')
    <style>
 
.hero {
    background: url('https://source.unsplash.com/1920x1080/?nature,landscape') no-repeat center center/cover;
    height: 90vh; /* পুরো ভিউপোর্ট জুড়ে রাখবে */
    display: flex;
    align-items: center;
    justify-content: center;
    color: white; /* টেক্সটের রং */
    text-align: center;
    text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5); /* টেক্সটে হালকা ছায়া */
    position: relative;
}
.hero-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    top: 0;
    left: 0;
}
.hero-text {
    position: relative;
    color: white;
    text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
}

/* মোবাইল বা ছোট স্ক্রিনের জন্য Responsive Design */
@media (max-width: 768px) {
    .hero {
        height: 80vh; /* ছোট স্ক্রিনে একটু কম জায়গা নিবে */
    }
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
    @endsection

    

    @section('header')

        {{-- <div class="container text-center">
            <h1>Welcome to My Blog</h1>
            <p>Read amazing articles on various topics</p>
        </div> --}}

        <img src="https://th.bing.com/th/id/OIP.AKgi45l98_qfkyBsBjPiDgAAAA?pid=ImgDet&w=182&h=122&c=7" class="hero-image" alt="Blog Banner">
        <div class="container text-center hero-text">
            <h1>Welcome to My Blog</h1>
            <p>Read amazing articles on various topics</p>
        </div>

            
    @endsection

    @section('content')

        <h2 class="text-center mb-4">Latest Posts</h2>
        <div class="row" id="blog-posts">
            <!-- Blog posts will be inserted dynamically -->
        </div>

        <!-- Pagination Controls -->
        <div class="text-center mt-4">
            <button id="prevPage" class="btn btn-secondary me-2" disabled>Previous</button>
            <span id="currentPage" class="fw-bold"></span>
            <button id="nextPage" class="btn btn-secondary ms-2" disabled>Next</button>
        </div>
            
    @endsection

    @section('footer')

        <div class="container text-center">
            <p>&copy; 2025 MyBlog. All rights reserved.</p>
        </div>
        
    @endsection


    @section('script')

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            let currentPage = 1; // বর্তমান পেজ নম্বর
            const blogContainer = document.getElementById("blog-posts");
            const prevPageBtn = document.getElementById("prevPage");
            const nextPageBtn = document.getElementById("nextPage");
            const currentPageDisplay = document.getElementById("currentPage");
        
            function fetchPosts(page = 1) {
                axios.get(`/api/posts?page=${page}`)
                    .then(response => {
                        const { posts, current_page, last_page, next_page_url, prev_page_url } = response.data;
        
                        // UI আপডেট
                        blogContainer.innerHTML = "";
                        if (posts.length === 0) {
                            blogContainer.innerHTML = `<p class="text-center">No posts available.</p>`;
                            return;
                        }
        
                        posts.forEach(post => {
                            const postElement = `
                                <div class="col-md-4">
                                    <div class="card mb-4">
                                        <img src="${post.image ? '/storage/' + post.image : 'https://via.placeholder.com/400x300'}" class="card-img-top" alt="${post.title}">
                                        <div class="card-body">
                                            <h5 class="card-title">${post.title}</h5>
                                            <p class="card-text">${post.content.substring(0, 100)}...</p>
                                            <a href="/blog/${post.id}" class="btn btn-primary">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            `;
                            blogContainer.innerHTML += postElement;
                        });
        
                        // Pagination UI আপডেট
                        currentPage = current_page;
                        currentPageDisplay.textContent = `Page ${current_page} of ${last_page}`;
                        
                        // Previous & Next বাটন সক্রিয়/নিষ্ক্রিয় করা
                        prevPageBtn.disabled = !prev_page_url;
                        nextPageBtn.disabled = !next_page_url;
        
                        // বাটনে ক্লিক করে Pagination Handle করা
                        prevPageBtn.onclick = () => fetchPosts(currentPage - 1);
                        nextPageBtn.onclick = () => fetchPosts(currentPage + 1);
                    })
                    .catch(error => {
                        console.error("Error fetching posts:", error);
                        blogContainer.innerHTML = `<p class="text-center text-danger">Failed to load posts. Please try again later.</p>`;
                    });
            }
        
            // প্রথমবার পেজ লোড হলে ডাটা আনবে
            fetchPosts();
        });
    </script>
      {{-- <script>
        document.addEventListener("DOMContentLoaded", () => {
            const blogContainer = document.getElementById("blog-posts");
        
            // Fetch posts from API
            axios.get('/api/posts')
                .then(response => {
                    const posts = response.data.data; // Adjusted for Laravel pagination
                    blogContainer.innerHTML = ""; // Clear previous content
        
                    if (posts.length === 0) {
                        blogContainer.innerHTML = `<p class="text-center">No posts available.</p>`;
                        return;
                    }
        
                    // Loop through API posts and insert them into the UI
                    posts.forEach(post => {
                        const postElement = `
                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <img src="${post.image ? '/storage/' + post.image : 'https://via.placeholder.com/400x300'}" class="card-img-top" alt="${post.title}">
                                    <div class="card-body">
                                        <h5 class="card-title">${post.title}</h5>
                                        <p class="card-text">${post.content.substring(0, 100)}...</p>
                                        <a href="#" class="btn btn-primary">Read More</a>
                                    </div>
                                </div>
                            </div>
                        `;
                        blogContainer.innerHTML += postElement;
                    });
                })
                .catch(error => {
                    console.error("Error fetching posts:", error);
                    blogContainer.innerHTML = `<p class="text-center text-danger">Failed to load posts. Please try again later.</p>`;
                });
        });
        </script> --}}
    @endsection


</body>
</html>

