<?php
// =====================================
// CONFIG (replace with real data later)
// =====================================
$bmi_category = "underweight"; // underweight | normal | overweight | obese
$level = "beginner"; // beginner | intermediate

$plan = [];

// =====================================
// PLAN LOGIC (SWITCH)
// =====================================
switch($level) {

  case "beginner":

    switch($bmi_category) {

      case "normal":
        $plan = [
          ["Push Ups", "Upper body strength", "10"],
          ["Squats", "Lower body", "15"],
          ["Plank", "Core stability", "30s"]
        ];
        break;

      case "overweight":
        $plan = [
          ["Modified Push Ups", "Beginner friendly", "8"],
          ["Squats", "Lower body", "10"],
          ["Brisk Walking", "Cardio", "10 min"]
        ];
        break;

      case "obese":
        $plan = [
          ["Wall Push Ups", "Low impact", "8"],
          ["Chair Squats", "Assisted", "8"],
          ["Slow Walking", "Light cardio", "5–10 min"]
        ];
        break;

      case "underweight":
        $plan = [
          ["Push Ups", "Strength", "12"],
          ["Squats", "Muscle gain", "15"],
          ["Dumbbell Curl", "Arms", "10"]
        ];
        break;
    }

  break;


  case "intermediate":

    switch($bmi_category) {

      case "normal":
        $plan = [
          ["Push Ups", "Upper body", "15"],
          ["Squats", "Legs", "20"],
          ["Plank", "Core", "45s"],
          ["Burpees", "Full body", "10"]
        ];
        break;

      case "overweight":
        $plan = [
          ["Push Ups", "Strength", "10"],
          ["Squats", "Legs", "15"],
          ["Plank", "Core", "30s"],
          ["Brisk Walking", "Cardio", "15 min"]
        ];
        break;

      case "obese":
        $plan = [
          ["Wall Push Ups", "Low impact", "10"],
          ["Chair Squats", "Assisted", "10"],
          ["Seated Marching", "Cardio", "2 min"]
        ];
        break;

      case "underweight":
        $plan = [
          ["Push Ups", "Strength", "15"],
          ["Squats", "Muscle gain", "20"],
          ["Dumbbell Curl", "Arms", "12"],
          ["Plank", "Core", "40s"]
        ];
        break;
    }

  break;
}
?>

<!-- ===================================== -->
<!-- MODAL -->
<!-- ===================================== -->
<div class="modal fade" id="beginnerModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content modern-modal">

      <!-- HEADER -->
      <div class="modal-header border-0 align-items-start">
        <div class="info-strip d-flex gap-4">
          <div class="ms-3">
            <span>Date</span>
            <strong><?php echo date("M d, Y"); ?></strong>
          </div>
          <div>
            <span>Duration</span>
            <strong>20–30 min</strong>
          </div>
          <div>
            <span>Level</span>
            <strong><?= ucfirst($level) ?></strong>
          </div>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <!-- BODY -->
      <div class="modal-body">

        <form action="save_plan.php" method="POST">

          <!-- hidden meta -->
          <input type="hidden" name="plan_type" value="<?= $level ?>">
          <input type="hidden" name="bmi_category" value="<?= $bmi_category ?>">

          <!-- INFO STRIP -->
          <div class="info-strip mb-4">
            <div>
              <span>Duration</span>
              <strong>20–30 min</strong>
            </div>
            <div>
              <span>Level</span>
              <strong><?= ucfirst($level) ?></strong>
            </div>
            <div>
              <span>Focus</span>
              <strong>Full Body</strong>
            </div>
          </div>

          <!-- WORKOUT LIST -->
          <div class="exercise-list">
            <?php foreach($plan as $exercise): ?>
              <div class="exercise-item">
                <div>
                  <p class="mb-0"><?= $exercise[0] ?></p>
                  <small><?= $exercise[1] ?></small>
                </div>
                <strong><?= $exercise[2] ?></strong>
              </div>
            <?php endforeach; ?>
          </div>

          <!-- Hidden values (dynamic) -->
          <?php foreach($plan as $i => $exercise): ?>
            <input type="hidden" name="exercise<?= $i ?>" value="<?= $exercise[0] ?>">
          <?php endforeach; ?>

          <!-- ACTION -->
          <button type="submit" class="btn modern-btn w-100 mt-4">
            Save Plan
          </button>

        </form>

      </div>

    </div>
  </div>
</div>