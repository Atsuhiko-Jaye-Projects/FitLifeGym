<div class="modal fade" id="workoutPlanModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content text-white" style="background:#1e1e2f;">

            <!-- Header -->
            <div class="modal-header border-secondary">
                <h5 class="modal-title">
                    <i class="bi bi-journal-text me-2 text-info"></i>
                    Workout Plan Details
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">

                <div class="mb-3">
                    <span class="badge bg-success px-3 py-2">
                        <i class="bi bi-check-circle me-1"></i>
                        Active Plan
                    </span>
                </div>

                <p><strong>Workout Plan ID:</strong> <?php echo $workout_plan->workout_plan_id ?? 'N/A'; ?></p>
                <p><strong>Plan:</strong> <?php echo $workout_plan->workout_plan ?? 'N/A'; ?></p>
                <p><strong>Level:</strong> <?php echo $workout_plan->level ?? 'N/A'; ?></p>
                <p><strong>Duration:</strong> <?php echo ($workout_plan->duration ?? 'N/A') . ' Weeks'; ?></p>
                <p><strong>Days per Week:</strong> <?php echo $workout_plan->day_per_week ?? 'N/A'; ?></p>

                <hr class="border-secondary">

                <!-- Warning Section -->

            <!-- Footer -->
            <div class="modal-footer border-secondary d-flex justify-content-between">

                <button class="btn btn-outline-light" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i>
                    Close
                </button>

                <!-- Cancel Plan Button -->
                <button type="button"
                        class="btn btn-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#confirmCancelModal">
                    <i class="bi bi-trash me-1"></i>
                    Cancel Plan
                </button>

            </div>

        </div>

    </div>
</div>

