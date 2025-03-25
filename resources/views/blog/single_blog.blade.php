
@extends('layout.app')

    @section('style')
        <style>

                /* Post Section */
            #post-container {
                background: white;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
                transition: transform 0.3s ease-in-out;
            }

            #post-container:hover {
                transform: translateY(-5px);
            }

            #post-image {
                width: 100%;
                max-height: 400px;
                object-fit: cover;
                border-radius: 10px;
            }

            #post-title {
                font-size: 2rem;
                font-weight: bold;
                margin-top: 20px;
            }

            #post-content {
                font-size: 1.2rem;
                line-height: 1.6;
                color: #333;
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
            
    @endsection



    @section('content')
        <div id="post-container">
            <!-- Post content will be loaded here -->
        </div>
    @endsection

    @section('footer')

        <div class="container text-center">
            <p>&copy; 2025 MyBlog. All rights reserved.</p>
        </div>
        
    @endsection


    @section('script')
        <script>
            // script.js

            document.addEventListener("DOMContentLoaded", () => {
                // // Get the post ID from the URL (e.g., /single-post.html?id=1)
                // const urlParams = new URLSearchParams(window.location.search);
                // const postId = urlParams.get('id'); // Retrieve the 'id' parameter from URL

                // Retrieve the post ID passed from the route
                const postId = @json($id); // This will embed the ID into the JavaScript code

                if (!postId) {
                    document.getElementById("post-container").innerHTML = "<p class='text-center text-danger'>No post ID found.</p>";
                    return;
                }

                // Fetch the specific post using Axios
                axios.get(`/api/posts/${postId}`)
                    .then(response => {
                        const post = response.data;

                        // Dynamically load the post content
                        const postContainer = document.getElementById("post-container");
                        postContainer.innerHTML = `
                            <img src="${post.image ? '/storage/' + post.image : 'https://via.placeholder.com/600x400'}" alt="${post.title}" class="img-fluid" id="post-image">
                            <h2 id="post-title">${post.title}</h2>
                            <p id="post-content">${post.content}</p>
                        `;
                    })
                    .catch(error => {
                        console.error("Error fetching post:", error);
                        document.getElementById("post-container").innerHTML = "<p class='text-center text-danger'>Post not found or error occurred.</p>";
                    });
            });


        </script>
    @endsection


</body>
</html>

