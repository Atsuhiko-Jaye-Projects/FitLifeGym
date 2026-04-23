<style>
.modal-content {
    border-radius: 14px;
    border: none;
    background: #1e1e2f;
    color: #fff;
}

.modal-header, .modal-footer {
    border-color: rgba(255,255,255,0.08);
}

.modal-body {
    padding: 2rem 1.8rem;
}

/* Profile top center */
.profile-container {
    text-align: center;
    margin-bottom: 20px;
}

.profile-preview {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #6c63ff;
    margin-bottom: 10px;
}

.file-input {
    max-width: 220px;
    margin: 0 auto;
}

/* Floating inputs */
.form-floating > .form-control {
    background: #2a2a3d;
    border: none;
    color: #fff;
    border-radius: 10px;
}

.form-floating > label {
    color: #aaa;
}

.form-control:focus {
    box-shadow: 0 0 0 0.15rem rgba(108,99,255,0.3);
}

/* Buttons */
.btn-primary {
    background: #6c63ff;
    border: none;
    border-radius: 8px;
}

.btn-primary:hover {
    background: #5a52e0;
}
</style>

<div class="modal fade" id="editProfileModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Edit Profile</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="user_id" value="<?php echo $user->id; ?>">
                    <!-- Profile Top Center -->
                    <div class="profile-container">
                        <img src="<?php echo !empty($user->profile_image) ? $user->profile_image : $base_url . 'assets/images/logo.png'; ?>"
                             id="preview" class="profile-preview">
                        <input type="file" name="profile_pic" 
                               class="form-control file-input" 
                               id="fileInput" accept="image/*">
                        <small class="text-muted d-block mt-1">
                            Change profile picture
                        </small>
                    </div>

                    <!-- Form Fields -->
                    <div class="row g-3">

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="firstname" class="form-control"
                                    value="<?php echo $user->firstname; ?>" placeholder="First Name" required>
                                <label>First Name</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="lastname" class="form-control"
                                    value="<?php echo $user->lastname; ?>" placeholder="Last Name" required>
                                <label>Last Name</label>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" name="email_address" class="form-control"
                                    placeholder="Email Address" value="<?php echo $user->email_address; ?>">
                                <label>Email Address</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input 
                                    type="text" 
                                    name="contact_number" 
                                    class="form-control"
                                    placeholder="Contact No"
                                    pattern="^09\d{9}$"
                                    maxlength="11"
                                    inputmode="numeric"
                                    title="Enter a valid 11-digit number starting with 09 (e.g. 09533307696)"
                                    value="<?php echo $user->contact_no; ?>"
                                    required>
                                <label>Contact No</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="password" name="new_password" class="form-control"
                                    placeholder="Current Password">
                                <label>New Password</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="password" name="confirm_password" class="form-control"
                                    placeholder="New Password">
                                <label>Confirm Password</label>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="password" name="current_password" class="form-control"
                                    placeholder="Confirm Password">
                                <label>Current Password</label>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
// Image preview only (clean and useful)
document.getElementById("fileInput").addEventListener("change", function(e) {
    const [file] = e.target.files;
    if (file) {
        document.getElementById("preview").src = URL.createObjectURL(file);
    }
});
</script>