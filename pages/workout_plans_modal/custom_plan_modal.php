<div class="modal fade" id="customModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content modern-modal">

      <!-- HEADER -->
      <div class="modal-header border-0">
        <h5 class="modal-title fw-bold">
          <i class="bi bi-fire me-2 text-danger"></i> Beginner Plan
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <!-- BODY -->
      <div class="modal-body">

        <form action="save_plan.php" method="POST">

          <input type="hidden" name="plan_type" value="beginner">

          <!-- Preset Section -->
          <div class="section-card mb-3">
            <h6><i class="bi bi-lightning-charge me-2"></i>Preset Routine</h6>

            <div class="row g-2 mt-2">

              <div class="col-md-4">
                <label>Push Ups</label>
                <select name="pushups" class="form-select modern-input">
                  <option>10 reps</option>
                  <option>15 reps</option>
                  <option>20 reps</option>
                </select>
              </div>

              <div class="col-md-4">
                <label>Squats</label>
                <select name="squats" class="form-select modern-input">
                  <option>15 reps</option>
                  <option>20 reps</option>
                  <option>30 reps</option>
                </select>
              </div>

              <div class="col-md-4">
                <label>Plank</label>
                <select name="plank" class="form-select modern-input">
                  <option>30 sec</option>
                  <option>45 sec</option>
                  <option>60 sec</option>
                </select>
              </div>

            </div>
          </div>

          <!-- Custom Section -->
          <div class="section-card">
            <h6><i class="bi bi-sliders me-2"></i>Customization</h6>

            <div class="row g-2 mt-2">

              <div class="col-md-6">
                <label>Workout Days</label>
                <select name="days" class="form-select modern-input">
                  <option>3 days/week</option>
                  <option>4 days/week</option>
                  <option>5 days/week</option>
                </select>
              </div>

              <div class="col-md-6">
                <label>Difficulty</label>
                <select name="difficulty" class="form-select modern-input">
                  <option>Easy</option>
                  <option>Normal</option>
                  <option>Hard</option>
                </select>
              </div>

            </div>
          </div>

          <!-- BUTTON -->
          <button type="submit" class="btn modern-btn w-100 mt-4">
            <i class="bi bi-check-circle me-2"></i> Save Plan
          </button>

        </form>

      </div>

    </div>
  </div>
</div>