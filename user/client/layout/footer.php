<!-- ================= FOOTER ================= -->
<footer class="bg-dark text-white mt-5 pt-4 pb-3">
    <div class="container">
        <div class="row">

            <!-- Brand / About -->
            <div class="col-md-4 mb-3">
                <h5 class="fw-bold">FitLife Gym</h5>
                <p class="small text-muted">
                    Your personal fitness companion. Track workouts, monitor progress, and stay consistent every day.
                </p>
            </div>

            <!-- Quick Links -->
            <div class="col-md-4 mb-3">
                <h6 class="fw-semibold">Quick Links</h6>
                <ul class="list-unstyled small">
                    <li><a href="#" class="text-decoration-none text-light">Dashboard</a></li>
                    <li><a href="#" class="text-decoration-none text-light">Workout Plans</a></li>
                    <li><a href="#" class="text-decoration-none text-light">Progress Tracker</a></li>
                    <li><a href="#" class="text-decoration-none text-light">Profile</a></li>
                </ul>
            </div>

            <!-- Contact / Info -->
            <div class="col-md-4 mb-3">
                <h6 class="fw-semibold">Contact</h6>
                <p class="small mb-1">📍Marinduque, Mogpog</p>
                <p class="small mb-1">📧 fitlifegym@email.com</p>
                <p class="small mb-0">📞 +63 912 345 6789</p>
            </div>

        </div>

        <hr class="border-secondary">

        <!-- Bottom -->
        <div class="text-center small text-muted">
            © <?php echo date("Y"); ?> FitLife Gym. All rights reserved.
        </div>
    </div>
</footer>
<!-- ================= END FOOTER ================= -->
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php if (isset($_GET['action'])): ?>
<script>
document.addEventListener("DOMContentLoaded", function () {

<?php if ($_GET['action'] == 'plan_existed'): ?>
    Swal.fire({
        icon: "warning",
        title: "Plan Already Exists",
        text: "You already have an active workout plan.",
        confirmButtonText: "OK"
    }).then(() => removeAction());

<?php elseif ($_GET['action'] == 'created'): ?>
    Swal.fire({
        icon: "success",
        title: "Workout Created!",
        text: "Your workout plan and exercises were saved successfully.",
        confirmButtonText: "OK"
    }).then(() => removeAction());
<?php endif; ?>

    function removeAction() {
        const url = new URL(window.location);
        url.searchParams.delete('action');
        window.history.replaceState({}, document.title, url.pathname);
    }

});
</script>
<?php endif; ?>

<script>
function updateWorkout(id) {
    let btn = document.getElementById("btn" + id);
    let statusText = "";
    let progressValue = 0;

    const exerciseId = btn.dataset.exerciseId;
    const exerciseStatus = btn.dataset.status;
    const personalBest = document.getElementById("pb" + id).value;

    if (btn.innerText === "Start") {
        statusText = "in_progress";
        document.getElementById("status" + id).innerText = statusText;
        progressValue = 50;

        btn.innerText = "In progress";
        btn.classList.replace("btn-primary", "btn-warning");

    } else if (btn.innerText === "In progress") {

        statusText = "finished";
        document.getElementById("status" + id).innerText = statusText;
        progressValue = 100;

        btn.innerText = "Finished";
        btn.classList.replace("btn-warning", "btn-success");
        btn.disabled = true;
    }

    // Update UI
    document.getElementById("progressBar" + id).style.width = progressValue + "%";

    // 🔥 AJAX call
    fetch("../../api/utils/update_workout.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: JSON.stringify({
            exercise_id: exerciseId,
            status: statusText,
            progress: progressValue,
            personal_best: personalBest
        })
    })
    .then(async (res) => {
        const text = await res.text();

        console.log("RAW RESPONSE:", text);

        try {
            const data = JSON.parse(text);
            console.log("PARSED JSON:", data);

            if (data.success) {
                console.log("✅ Saved:", data);
            } else {
                console.error("❌ API Error:", data.message);
            }

        } catch (err) {
            console.error("❌ JSON Parse Error:", err);
        }
    })
    .catch(error => {
        console.error("❌ Fetch Failed:", error);
    });
}

// ==============================
// ORIGINAL FUNCTION (UNCHANGED)
// ==============================
function CreateWorkout(btn) {
    let statusText = "";
    let progressValue = 0;

    const id = btn.dataset.id;
    const name = btn.dataset.name;
    const duration = btn.dataset.duration;
    const sets = btn.dataset.sets;
    const day = btn.dataset.day;
    const status = btn.dataset.status;
    const workID = btn.dataset.workplanId;

    if (btn.innerText === "Start") {
        statusText = "In progress";
        document.getElementById("status" + id).innerText = statusText;
        progressValue = 50;

        btn.innerText = "In Progress";
        btn.classList.replace("btn-primary", "btn-warning");

    } else if (btn.innerText === "In Progress") {
        statusText = "finished";
        document.getElementById("status" + id).innerText = statusText;
        progressValue = 100;

        btn.innerText = "Finished";
        btn.classList.replace("btn-warning", "btn-success");
        btn.disabled = true;
    }

    // Update UI
    document.getElementById("progressBar" + id).style.width = progressValue + "%";

    // ✅ JSON API call
    fetch("../../api/utils/create_workout.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            exercise_id: id,
            workplan_id: workID,
            workplan: name,
            duration: duration,
            sets: sets,
            day: day,
            status: statusText,
            progress: progressValue
        })
    })
    .then(async (res) => {
        const text = await res.text();

        console.log("RAW RESPONSE:", text);

        try {
            const data = JSON.parse(text);
            console.log("PARSED JSON:", data);

            if (data.success) {
                console.log("✅ Saved:", data);
            } else {
                console.error("❌ API Error:", data.message);
            }

        } catch (err) {
            console.error("❌ JSON Parse Error:", err);
        }
    })
    .catch(error => {
        console.error("❌ Fetch Failed:", error);
    });
}


// =======================================
// 🔥 ADDED: DISABLE / ENABLE OTHER BUTTONS
// =======================================
document.addEventListener("click", function(e) {

    if (e.target.classList.contains("workout-btn")) {

        const btn = e.target;

        // When START is clicked
        if (btn.innerText === "Start") {

            document.querySelectorAll(".workout-btn").forEach(b => {
                if (b !== btn) {
                    b.disabled = true;
                }
            });

        }

        // When FINISH is triggered
        else if (btn.innerText === "In Progress") {

            setTimeout(() => {
                document.querySelectorAll(".workout-btn").forEach(b => {
                    if (b.innerText === "Start") {
                        b.disabled = false;
                    }
                });
            }, 100);
        }
    }

});


// =======================================
// 🔥 ADDED: HANDLE PAGE REFRESH STATE
// =======================================
window.addEventListener("load", () => {

    let hasActive = false;

    document.querySelectorAll(".workout-btn").forEach(btn => {
        if (btn.innerText === "In Progress") {
            hasActive = true;
        }
    });

    if (hasActive) {
        document.querySelectorAll(".workout-btn").forEach(btn => {
            if (btn.innerText === "Start") {
                btn.disabled = true;
            }
        });
    }

});

document.querySelectorAll('.timer-btn').forEach(btn => {
    const start = new Date(btn.dataset.start).getTime();
    const duration = parseInt(btn.dataset.duration);
    const end = start + (duration * 60 * 1000);

    const id = btn.dataset.exerciseId;

    function updateCountdown() {
        const now = new Date().getTime();
        const remaining = end - now;

        if (remaining <= 0) {
            btn.disabled = false;

            // 👇 Decide what text based on status
            if (btn.dataset.status === "In progress") {
                btn.innerText = "In progress";
            } else {
                btn.disabled = true;
            }

            // 👇 attach your function
            btn.onclick = () => updateWorkout(id);
            return;
        }

        const minutes = Math.floor((remaining / 1000) / 60);
        const seconds = Math.floor((remaining / 1000) % 60);

        btn.innerText = `⏳ ${minutes}:${seconds.toString().padStart(2, '0')}`;
    }

    updateCountdown();
    setInterval(updateCountdown, 1000);
});


document.getElementById("cancelWorkoutForm").addEventListener("submit", function(e) {
    e.preventDefault();

    const form = this;
    const formData = new FormData(form);

    fetch("../../../api/utils/cancel_workout.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            Swal.fire("Cancelled!", data.message, "success")
                .then(() => location.reload());
        } else {
            Swal.fire("Error!", data.message, "error");
        }
    })
    .catch(error => {
        Swal.fire({
            title: "Error!",
            text: "Something went wrong.",
            icon: "error"
        });
        console.error(error);
    });
});

</script>


<script>
document.addEventListener("DOMContentLoaded", function () {

    const input = document.getElementById("snapshotInput");
    const gallery = document.getElementById("snapshotGallery");

    input.addEventListener("change", function () {

        if (!this.files.length) return;

        let formData = new FormData();
        formData.append("snapshot", this.files[0]);

        fetch("../../../objects/upload_snapshot.php", {
            method: "POST",
            body: formData
        })
        .then(res => res.json())
        .then(data => {

            if (data.status === "success") {
                location.reload(); // simple refresh (safe approach)
            } else {
                alert(data.message);
            }

        })
        .catch(err => console.error(err));
    });

});
</script>