</div>
<script src="<?= base_url() ?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/jQuery/jquery.js"></script>
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