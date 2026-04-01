<div class="modal fade" id="intermidiateModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content modern-modal">

      <!-- HEADER -->
      <div class="modal-header border-0 align-items-start">
        <div class="info-strip mb-4">
          <div>
            <span>Date</span>
            <strong><?php echo date("M d, Y"); ?></strong>
          </div>
          <div>
            <span>Duration</span>
            <strong>20–30 min</strong>
          </div>
          <div>
            <span>Level</span>
            <strong>Beginner</strong>
          </div>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <!-- BODY -->
      <div class="modal-body">

        <form action="save_plan.php" method="POST">

          <input type="hidden" name="plan_type" value="beginner">

          <!-- INFO STRIP -->
          <div class="info-strip mb-4">
            <div>
              <span>Duration</span>
              <strong>20–30 min</strong>
            </div>
            <div>
              <span>Level</span>
              <strong>Beginner</strong>
            </div>
            <div>
              <span>Focus</span>
              <strong>Full Body</strong>
            </div>
          </div>

          <!-- WORKOUT LIST -->
          <div class="exercise-list">

            <div class="exercise-item">
              <div>
                <p class="mb-0">Push Ups</p>
                <small>Upper body strength</small>
              </div>
              <strong>10</strong>
            </div>

            <div class="exercise-item">
              <div>
                <p class="mb-0">Squats</p>
                <small>Lower body</small>
              </div>
              <strong>15</strong>
            </div>

            <div class="exercise-item">
              <div>
                <p class="mb-0">Plank</p>
                <small>Core stability</small>
              </div>
              <strong>30s</strong>
            </div>

          </div>

          <!-- Hidden values -->
          <input type="hidden" name="pushups" value="10">
          <input type="hidden" name="squats" value="15">
          <input type="hidden" name="plank" value="30">

          <!-- ACTION -->
          <button type="submit" class="btn modern-btn w-100 mt-4">
            Save Plan
          </button>

        </form>

      </div>

    </div>
  </div>
</div>