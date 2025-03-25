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
                        <img id="imagePreview" class="image-preview d-none" />
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