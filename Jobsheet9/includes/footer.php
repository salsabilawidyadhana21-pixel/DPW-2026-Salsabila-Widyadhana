</main>

<footer class="site-footer">

    <p>
        &copy; 2026 SIMPUS-Mini — Jobsheet 9
    </p>

</footer>

<script src="<?= $base ?>assets/js/app.js"></script>

<?php

if (!empty($extra_scripts)):

    foreach ($extra_scripts as $src):

?>

        <script src="<?= $src ?>"></script>

<?php

    endforeach;

endif;

?>

</body>

</html>