</main>

<footer class="site-footer">
    <div class="container">
        <p>&copy; 2026 SIMPUS-Mini — Jobsheet 8</p>
    </div>
</footer>

<script src="<?= $base ?>assets/js/app.js"></script>

<?php if (!empty($extra_scripts)): ?>
    <?php foreach ($extra_scripts as $script): ?>
        <script src="<?= $base . $script ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>

</body>
</html>