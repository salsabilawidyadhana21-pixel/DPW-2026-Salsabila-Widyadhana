<?php
// Menentukan folder utama Jobsheet 
$base_path = '/Jobsheet13';
?>

</main>

<!-- =====================================================
     FOOTER
     ===================================================== -->
<footer>
    <p>&copy; <?= date('Y') ?> SIMPUS-Mini</p>
</footer>

<!-- =====================================================
     JAVASCRIPT
     ===================================================== -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const hamburgerBtn = document.getElementById('hamburger-btn');
    const navMenu = document.getElementById('nav-menu');

    if (hamburgerBtn && navMenu) {
        hamburgerBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            navMenu.classList.toggle('active');
        });

        // Menutup menu saat mengklik area luar navbar
        document.addEventListener('click', function(e) {
            if (!hamburgerBtn.contains(e.target) && !navMenu.contains(e.target)) {
                navMenu.classList.remove('active');
            }
        });
    }
});
</script>

<?php if (file_exists(__DIR__ . '/../assets/js/app.js')): ?>
    <script src="<?= $base_path ?>/assets/js/app.js"></script>
<?php endif; ?>

</body>
</html>