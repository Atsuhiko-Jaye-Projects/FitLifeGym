<div class="modal fade" id="customModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content modern-modal">

      <!-- HEADER -->
      <div class="modal-header border-0">
        <h5 class="modal-title fw-bold">
          <i class="bi bi-fire me-2 text-danger"></i> Custom Plan
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <!-- BODY -->
      <div class="modal-body">

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

          <input type="hidden" name="bmi_value" value="<?= htmlspecialchars($BMI_value) ?>">

          <!-- Preset Section -->
          <div class="section-card mb-3">
            <h6><i class="bi bi-lightning-charge me-2"></i>Preset Routine</h6>

            <div class="row g-2 mt-2">

              <div class="col-md-6">
                <label>Goal</label>
                <select name="plan_name" class="form-select modern-input">
                  <option value="Cardio">Cardio</option>
                  <option value="Strength">Strength</option>
                  <option value="Weight Loss">Weight Loss</option>
                  <option value="Muscle Gain">Muscle Gain</option>
                  <option value="Endurance">Endurance</option>
                  <option value="Flexibility">Flexibility</option>
                  <option value="General Fitness">General Fitness</option>
                </select>
              </div>

              <div class="col-md-6">
                <label>Intensity</label>
                <select name="plan_type" class="form-select modern-input">
                  <option value="beginner">Beginner</option>
                  <option value="intermediate">Intermediate</option>
                  <option value="advance">Advance</option>
                </select>
              </div>
            </div>
          </div>

          <!-- Custom Section -->
          <div class="section-card">
            <h6><i class="bi bi-sliders me-2"></i>Schedule</h6>

            <div class="row g-2 mt-2">

              <div class="col-md-4">
                <label>Workout Days/Week</label>
                <select name="day_per_week" class="form-select modern-input">
                  <option value="2">2 days/week</option>
                  <option value="3" selected>3 days/week</option>
                  <option value="4">4 days/week</option>
                  <option value="5">5 days/week</option>
                  <option value="6">6 days/week</option>
                </select>
              </div>

              <div class="col-md-4">
                <label>Session Duration</label>
                <select name="session_duration" class="form-select modern-input">
                  <option value="20">20 minutes</option>
                  <option value="30" selected>30 minutes</option>
                  <option value="45">45 minutes</option>
                  <option value="60">60 minutes</option>
                </select>
              </div>

              <div class="col-md-4">
                <label>Plan Duration (Weeks)</label>
                <select name="plan_duration_weeks" class="form-select modern-input">
                  <option value="2">2 weeks</option>
                  <option value="4" selected>4 weeks</option>
                  <option value="6">6 weeks</option>
                  <option value="8">8 weeks</option>
                  <option value="12">12 weeks</option>
                </select>
              </div>

            </div>
          </div>

        <div id="hiddenContainer_custom" class="mt-3"></div>
        <div id="modalBody_custom" class="mt-3"></div>
        </form>
          <!-- BUTTON -->
          <button class="btn modern-btn w-100 mt-4" onclick="loadCustomPlan('Custom', 'modalBody_custom', 'hiddenContainer_custom')">
            <i class="bi bi-check-circle me-2"></i> Generate Workout Plan
          </button>

        
        
      </div>

    </div>
  </div>
</div>