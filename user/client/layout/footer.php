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