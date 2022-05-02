</div>
<footer class="container-fluid text-center text-white bg-primary d-flex align-items-center justify-content-center footer">
    <span>© <?= date("Y") ?> Fiscalía General del Estado de Baja California</span>
</footer>
<script src="<?= base_url() ?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
    (function() {
        'use strict'

        var forms = document.querySelectorAll('.needs-validation')

        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
</body>

</html>