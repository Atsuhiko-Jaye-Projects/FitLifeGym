

<style>
body {
  background: #0f172a;
}

/* MODAL */
.modern-modal {
  background: #0f172a;
  border-radius: 15px;
}

/* BOX */
.bmi-box {
  background: #1f2a3a;
  border-radius: 15px;
  padding: 20px;
  border: 1px solid #ffffff22;
}

/* ICON STYLE */
.bmi-icon {
  font-size: 80px;
  transition: 0.3s;
}

/* COLORS PER CATEGORY */
.underweight { color: #38bdf8; }
.normal { color: #22c55e; }
.overweight { color: #f59e0b; }
.obese { color: #ef4444; }

/* BUTTON */
.modern-btn {
  background: linear-gradient(135deg, #3b82f6, #06b6d4);
  border: none;
  color: white;
  font-weight: bold;
  padding: 12px;
  border-radius: 10px;
}
/* Modal fade + slide from top */
.modal.fade .modal-dialog {
  transform: translateY(-50px);
  opacity: 0;
  transition: all 0.5s ease-out;
}

.modal.fade.show .modal-dialog {
  transform: translateY(0);
  opacity: 1;
}
</style>


<!-- ===================================== -->
<!-- BMI MODAL -->
<!-- ===================================== -->
<div class="modal fade" id="bmiModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content modern-modal">

      <!-- HEADER -->
      <div class="modal-header border-0">
        <h5 class="modal-title text-white">Record Your BMI</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <!-- BODY -->
      <div class="modal-body">

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
          <input type="hidden" name="action" value="record_bmi">
          <div class="container-fluid">
            <div class="row g-3 align-items-center">

              <!-- LEFT -->
              <div class="col-md-6">
                <div class="bmi-box h-100">

                  <h5 class="text-white mb-3">Your Details</h5>

                  <div class="mb-3">
                    <label class="form-label text-white">Height (cm)</label>
                    <input type="number" name="height" id="height" class="form-control" required>
                  </div>

                  <div class="mb-3">
                    <label class="form-label text-white">Weight (kg)</label>
                    <input type="number" name="weight" id="weight" class="form-control" required>
                  </div>

                  <input type="hidden" name="bmi" id="bmiValueInput">
                  <input type="hidden" name="bmi_classification" id="bmiCategoryInput">

                  <div id="bmiText" class="text-white mt-3 fw-bold"></div>

                </div>
              </div>

              <!-- RIGHT -->
              <div class="col-md-6">
                <div class="bmi-box h-100 d-flex flex-column justify-content-center align-items-center text-center">

                  <!-- ICON -->
                  <i id="bmiIcon" class="bi bi-person bmi-icon text-secondary"></i>

                  <h5 id="bmiCategory" class="text-white mt-3">
                    BMI Category Preview
                  </h5>

                </div>
              </div>

            </div>
          </div>

          <button type="submit" class="btn modern-btn w-100 mt-4">
            Save Record
          </button>

        </form>

      </div>
    </div>
  </div>
</div>


<script>
function updateBMIPreview() {
    let h = document.getElementById("height").value / 100;
    let w = document.getElementById("weight").value;

    if (!h || !w) return;

    let bmi = w / (h * h);
    let category = "";
    let icon = "bi-person";
    let colorClass = "";

    if (bmi < 18.5) {
        category = "Underweight";
        icon = "bi-person";
        colorClass = "underweight";
    } 
    else if (bmi < 25) {
        category = "Normal";
        icon = "bi-emoji-smile";
        colorClass = "normal";
    } 
    else if (bmi < 30) {
        category = "Overweight";
        icon = "bi-emoji-neutral";
        colorClass = "overweight";
    } 
    else {
        category = "Obese";
        icon = "bi-emoji-frown";
        colorClass = "obese";
    }

    // update text
    document.getElementById("bmiCategory").innerText = category;
    document.getElementById("bmiText").innerText = "BMI: " + bmi.toFixed(2);

    // update icon
    let iconEl = document.getElementById("bmiIcon");
    iconEl.className = "bi " + icon + " bmi-icon " + colorClass;

    // store value
    document.getElementById("bmiValueInput").value = bmi.toFixed(2);
    document.getElementById("bmiCategoryInput").value = category;
}

// EVENTS
document.getElementById("height").addEventListener("input", updateBMIPreview);
document.getElementById("weight").addEventListener("input", updateBMIPreview);
</script>

<!-- Bootstrap -->

