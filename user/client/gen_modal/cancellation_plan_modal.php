<!-- CONFIRM CANCEL MODAL -->
<div class="modal fade" id="confirmCancelModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content text-white" style="background:#1e1e2f;">

            <!-- Header -->
            <div class="modal-header border-secondary">
                <h5 class="modal-title text-danger">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    Confirm Cancellation
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <!-- Body -->
            <div class="modal-body text-center">

                <i class="bi bi-trash display-4 text-danger mb-3"></i>

                <h5>Are you sure?</h5>
                <p class="text-muted">
                    This action will cancel your workout plan and remove your current progress.
                </p>

            </div>

            <!-- Footer -->
            <div class="modal-footer border-secondary d-flex justify-content-between">

                <button class="btn btn-outline-light" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i>
                    No, Keep It
                </button>

                <!-- CONFIRM CANCEL ACTION -->
                <form method="POST" action="cancel_workout.php">
                    <input type="hidden" name="workout_plan_id"
                           value="<?php echo $workout_plan->workout_plan_id ?? ''; ?>">

                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-check-circle me-1"></i>
                        Yes, Cancel
                    </button>
                </form>

            </div>

        </div>

    </div>
</div>