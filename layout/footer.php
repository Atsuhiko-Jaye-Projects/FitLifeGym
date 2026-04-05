</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

<?php if (!empty($message)) : ?>
<script>
    Swal.fire({
        icon: '<?php echo $message_type; ?>',
        title: '<?php echo ($message_type == "error") ? "Oops..." : "Success!"; ?>',
        text: '<?php echo $message; ?>',
        background: '#1e1e2f',
        color: '#fff',
        confirmButtonColor: '#6c5ce7'
    });
</script>
<?php endif; ?>


<script>
const alerts = {
    please_login: {
        icon: 'warning',
        title: 'Login Required',
        text: 'Please login first to access that page.',
        background: '#1e1e2f',
        color: '#fff',
        confirmButtonColor: '#6c5ce7'
    }
};

const params = new URLSearchParams(window.location.search);
const action = params.get('action');

if (alerts[action]) {
    Swal.fire(alerts[action]).then(() => {
        // Remove query string without reload
        window.history.replaceState({}, document.title, window.location.pathname);
    });
}
</script>

</html>