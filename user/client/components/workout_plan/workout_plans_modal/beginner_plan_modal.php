<?php

$fitnessLevel = "Beginner";
$bmiCategory = $category;

$plan = $workout_plan->getWorkoutPlanPreset($bmiCategory, $fitnessLevel);

$plan_intensity = $plan['intensity'] ?? '';
$plan_focus = $plan['focus'] ?? '';
$plan_duration = $plan['session_duration'] ?? '';
$plan_day_per_week = $plan['days_per_week'] ?? '';

?>

<!-- ===================================== -->
<!-- MODAL -->
<!-- ===================================== -->
<div class="modal fade" id="beginnerModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content modern-modal">

      <!-- HEADER -->
      <div class="modal-header border-0 align-items-start">

    <div class="info-strip row text-white w-100 mx-0 mb-3">

        <div class="col-md-4 col-12 mb-2 mb-md-0">
            <div class="p-3 rounded bg-dark bg-opacity-50 text-center h-100">
                <small class="text-white-50 d-block">📅 Date</small>
                <strong><?= date("M d, Y"); ?></strong>
            </div>
        </div>

        <div class="col-md-4 col-12 mb-2 mb-md-0">
            <div class="p-3 rounded bg-dark bg-opacity-50 text-center h-100">
                <small class="text-white-50 d-block">⏱ Session Duration</small>
                <strong><?= $plan_duration; ?> mins</strong>
            </div>
        </div>

        <div class="col-md-4 col-12">
            <div class="p-3 rounded bg-dark bg-opacity-50 text-center h-100">
                <small class="text-white-50 d-block">🔥 Level</small>
                <strong><?= ucfirst($fitnessLevel) ?></strong>
            </div>
        </div>

    </div>

        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <!-- BODY -->
      <div class="modal-body">

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <div id="hiddenInputs_beginner"></div>
        <input type="hidden" id="session_duration" name="session_duration">
        <input type="hidden" name="plan_type" value="<?= htmlspecialchars($fitnessLevel) ?>">
        <input type="hidden" name="bmi_category" value="<?= htmlspecialchars($bmiCategory) ?>">
        <input type="hidden" name="plan_name" value="<?= htmlspecialchars($plan_focus ?? '') ?>">
        <input type="hidden" name="bmi_value" value="<?= htmlspecialchars($BMI_value) ?>">
        <input type="hidden" name="day_per_week" value="<?= htmlspecialchars($plan_day_per_week) ?>">
        <div class="modal-body">
            <div id="modalBody_beginner">
                <p>Loading...</p>
                <button type="submit" class="btn modern-btn w-100 mt-4">
                  Save Plan
                </button>
            </div>
        </div>
          
        </form>

      </div>
    </div>
  </div>
</div>