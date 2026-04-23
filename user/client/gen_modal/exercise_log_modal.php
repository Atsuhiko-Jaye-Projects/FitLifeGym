<div class="modal fade" id="activityModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content text-white" style="background:#1e1e2f;">

            <!-- Header -->
            <div class="modal-header border-secondary">
                <h5 class="modal-title">
                    <i class="bi bi-clock-history me-2 text-info"></i>
                    Full Activity Log
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">

                <?php if ($exercise_log_num > 0): ?>

                    <ul class="list-unstyled mb-0">

                        <?php while ($row = $exercise_log_stmt->fetch(PDO::FETCH_ASSOC)): ?>

                            <li class="d-flex justify-content-between align-items-center py-2 border-bottom border-secondary">

                                <div class="d-flex align-items-center">
                                    <i class="bi bi-dumbbell text-warning me-2"></i>
                                    <span><?php echo $row['workout']; ?></span>
                                </div>

                                <small class="text-muted">
                                    <?php echo date("M d, Y", strtotime($row['modified_at'])); ?>
                                </small>

                            </li>

                        <?php endwhile; ?>

                    </ul>

                <?php else: ?>
                    <p class="text-muted text-center">No activity yet.</p>
                <?php endif; ?>

            </div>

            <!-- Footer -->
            <div class="modal-footer border-secondary">
                <button class="btn btn-outline-light" data-bs-dismiss="modal">
                    Close
                </button>
            </div>

        </div>

    </div>
</div>