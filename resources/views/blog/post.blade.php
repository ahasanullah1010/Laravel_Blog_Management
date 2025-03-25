
@extends('layout.app')

    @section('style')
        <style>

            .con {
                    max-width: 500px;
                }

                .card {
                    border-radius: 15px;
                    background: white;
                    animation: fadeIn 0.5s ease-in-out;
                }

                .btn-primary {
                    background-color: #6a11cb;
                    border: none;
                }

                .btn-primary:hover {
                    background-color: #2575fc;
                }

                .alert {
                    font-weight: bold;
                    text-align: center;
                }

                @keyframes fadeIn {
                    from {
                        opacity: 0;
                        transform: translateY(-10px);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
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

        
        </style>
        
    @endsection

   
{{-- @include('component.post_edit_modal') --}}


    @section('header')
            
    @endsection



    @section('content')

    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="text-center mb-4">Create a New Post</h2>
            <form id="postForm">
                <div class="mb-3">
                    <label class="form-label">Title:</label>
                    <input type="text" id="title" class="form-control" placeholder="Enter post title" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Content:</label>
                    <textarea id="content" class="form-control" rows="4" placeholder="Write your content..." required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Upload Image:</label>
                    <input type="file" id="image" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary w-100">Create Post</button>
            </form>
            <div id="message" class="alert mt-3 d-none"></div>
        </div>
    </div>
   
    @endsection

    @section('blogs')
    <h2 class=" mb-4">Latest Posts</h2>
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




        <!-- Edit Post Modal -->
<div class="modal fade" id="editPostModal" tabindex="-1" aria-labelledby="editPostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPostModalLabel">Edit Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editPostForm">
                    <div class="mb-3">
                        <label for="postTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="postTitle" required>
                    </div>
                    <div class="mb-3">
                        <label for="postContent" class="form-label">Content</label>
                        <textarea class="form-control" id="postContent" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="postImage" class="form-label">Upload Image (Optional)</label>
                        <input type="file" class="form-control" id="postImage" accept="image/*">
                        <p id="imageName" class="text-muted mt-2"></p> <!-- ইমেজের নাম দেখানোর জন্য -->
                    </div>
                    <input type="hidden" id="postId">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-save" onclick="updatePost()">Save Changes</button>
            </div>
        </div>
    </div>
</div>





<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deletePostModal" tabindex="-1" aria-labelledby="deletePostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePostModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this post?</p>
                <input type="hidden" id="deletePostId"> <!-- Hidden field to store post ID -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="confirmDeletePost()">Delete</button>
            </div>
        </div>
    </div>
</div>



    @section('footer')

        <div class="container text-center">
            <p>&copy; 2025 MyBlog. All rights reserved.</p>
        </div>
        
    @endsection


    @section('script')
        <script>
            document.getElementById('postForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            let formData = new FormData();
            formData.append('title', document.getElementById('title').value);
            formData.append('content', document.getElementById('content').value);
            
            let imageInput = document.getElementById('image').files[0];
            if (imageInput) {
                formData.append('image', imageInput);
            }

            axios.post('/api/posts', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'Authorization': 'Bearer YOUR_ACCESS_TOKEN' // If authentication is required
                }
            })
            .then(response => {
                showMessage('Post created successfully!', 'success');
                document.getElementById('postForm').reset(); // Clear form after submission
            })
            .catch(error => {
                showMessage('Error creating post. Please try again.', 'danger');
                console.error(error);
            });
            });

            function showMessage(message, type) {
                let messageDiv = document.getElementById('message');
                messageDiv.innerText = message;
                messageDiv.className = `alert alert-${type} mt-3`;
                messageDiv.classList.remove('d-none');
            }
        </script>

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
                                        <button class="btn btn-secondary edit-btn"  
                                            data-id="${post.id}" data-title="${post.title}" data-content="${post.content}" 
                                            data-image="${post.image ? '/storage/' + post.image : ''}">  Edit
                                        </button>
                                        <Button class="btn btn-danger" onclick="openDeleteModal(${post.id})">Delete</Button>
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







        // update post
        // document.addEventListener("DOMContentLoaded", () => {
    const editModal = new bootstrap.Modal(document.getElementById("editPostModal"));
    
    // Edit Button Click Event (Load Data into Modal)
    document.addEventListener("click", (event) => {
        if (event.target.classList.contains("edit-btn")) {
            const postId = event.target.getAttribute("data-id");
            const postTitle = event.target.getAttribute("data-title");
            const postContent = event.target.getAttribute("data-content");
            const postImage = event.target.getAttribute("data-image");

            // Set data in Modal fields
            document.getElementById("postId").value = postId;
            document.getElementById("postTitle").value = postTitle;
            document.getElementById("postContent").value = postContent;

            // Set image preview if exists
            const imageNameContainer = document.getElementById("imageName"); // Create a <p> or <span> for image name
            if (postImage) {
                imageNameContainer.textContent = postImage.split('/').pop(); // Only show file name
                imageNameContainer.classList.remove("d-none");
            } else {
                imageNameContainer.classList.add("d-none");
            }


            editModal.show();
        }
    });

    // Function to Update Post
    window.updatePost = function () {
        const postId = document.getElementById("postId").value;
        const title = document.getElementById("postTitle").value;
        const content = document.getElementById("postContent").value;
        const image = document.getElementById("postImage").files[0];

        // FormData to send file + text data
        let formData = new FormData();
        formData.append("title", title);
        formData.append("content", content);
        if (image) {
            formData.append("image", image);
        }
        formData.append("_method", "PUT"); // Laravel requires this for PUT method in FormData

        axios.post(`/api/posts/${postId}`, formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        })
        .then(response => {
            alert("Post updated successfully!");
            editModal.hide();
            // location.reload(); // Reload page to reflect changes
            fetchPosts();
        })
        .catch(error => {
            console.error("Error updating post:", error);
            alert("Failed to update post. Please try again.");
        });
    };
});

    // });





    // delete post
    function openDeleteModal(postId) {
    document.getElementById("deletePostId").value = postId; // Store post ID
    var deleteModal = new bootstrap.Modal(document.getElementById("deletePostModal"));
    deleteModal.show(); // Show the modal
}

function confirmDeletePost() {
    const postId = document.getElementById("deletePostId").value;

    axios.delete(`/api/posts/${postId}`)
        .then(response => {
            alert("Post deleted successfully!");

            // Hide the modal after successful deletion
            var deleteModal = bootstrap.Modal.getInstance(document.getElementById("deletePostModal"));
            deleteModal.hide();
            // fetchPosts();

            location.reload(); // Reload the page to update posts
        })
        .catch(error => {
            console.error("Error deleting post:", error);
            alert("Failed to delete post. Please try again.");
        });
}


</script>
    @endsection


</body>
</html>

