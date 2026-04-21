<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-white">
            
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileLabel">Edit Profile</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">

                    <!-- First Name -->
                    <div class="row">
                        
                        <!-- First Name -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" name="firstname" class="form-control" 
                                value="<?php echo $_SESSION['firstname']; ?>" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="firstname" class="form-control" 
                                value="<?php echo $_SESSION['firstname']; ?>" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Password</label>
                            <input type="text" name="firstname" class="form-control" 
                                value="<?php echo $_SESSION['firstname']; ?>" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Profile Picture</label>
                            <input type="file" name="profile_pic" class="form-control">
                            <small class="text-muted">Leave blank to keep current photo</small>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-light">Save Changes</button>
                </div>
            </form>

        </div>
    </div>
</div>
