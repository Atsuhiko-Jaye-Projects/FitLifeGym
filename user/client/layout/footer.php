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
</script>