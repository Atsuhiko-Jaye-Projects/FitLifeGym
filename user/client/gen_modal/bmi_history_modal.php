<style>
    
</style>
<div class="modal fade" id="bmiHistoryModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">
          <i class="bi bi-clock-history me-2"></i> BMI History
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- THIS makes it scroll instead of expanding -->
      <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
        <?php
            if ($BRH_num > 0) {

                while ($row = $BRH_stmt->fetch(PDO::FETCH_ASSOC)) {

                    echo '
                    <div class="card mb-2">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">
                                    BMI: ' . $row['BMI'] . ' (' . $row['bmi_classification'] . ')
                                </h6>
                                <small class="text-muted">
                                    ' . date("F d, Y", strtotime($row['created_at'])) . '
                                </small>
                            </div>
                            <span class="badge bg-success">
                                ' . $row['bmi_classification'] . '
                            </span>
                        </div>
                    </div>
                    ';
                }

            } else {

                echo '
                <div class="text-center text-muted py-4">
                    <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                    No BMI history found.
                </div>
                ';
            }
        ?>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>