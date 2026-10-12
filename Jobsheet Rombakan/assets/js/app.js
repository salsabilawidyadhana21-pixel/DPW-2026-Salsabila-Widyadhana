// Toggle hamburger menu di mobile
function setupNav() {
    var btn = document.getElementById("nav-toggle-btn");
    var nav = document.querySelector("header nav");

    if (btn && nav) {
        btn.addEventListener("click", function () {
            nav.classList.toggle("nav-open");
        });
    }
}

// Fitur konfirmasi hapus baris tabel
function setupHapus() {
    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("btn-hapus")) {
            var row = e.target.closest("tr");
            var nama = row ? row.cells[0].textContent : "data ini";

            if (confirm("Yakin mau hapus " + nama + "?")) {
                row.remove();
            }
        }
    });
}

// Fitur pencarian kata kunci pada tabel
function setupSearch() {
    var input = document.getElementById("search-input");
    var table = document.querySelector(".table-responsive table");

    if (!input || !table) return;

    input.addEventListener("keyup", function () {
        var filter = input.value.toLowerCase();
        var rows = table.querySelectorAll("tbody tr");

        rows.forEach(function (row) {
            var text = row.textContent.toLowerCase();
            if (text.indexOf(filter) > -1) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
}

// Validasi sederhana form tambah
function setupFormValidation() {
    var form = document.getElementById("form-tambah");
    if (!form) return;

    form.addEventListener("submit", function (e) {
        var inputs = form.querySelectorAll("input[required]");
        var isValid = true;

        inputs.forEach(function (input) {
            // Cek jika ada input error sebelumnya
            var next = input.nextElementSibling;
            if (next && next.classList.contains("error")) {
                next.remove();
            }

            if (input.value.trim() === "") {
                isValid = false;
                var err = document.createElement("span");
                err.className = "error";
                err.textContent = "Kolom ini harus diisi!";
                input.after(err);
            }
        });

        if (!isValid) {
            e.preventDefault();
        }
    });
}

// Jalankan semua saat dokumen siap
document.addEventListener("DOMContentLoaded", function () {
    setupNav();
    setupHapus();
    setupSearch();
    setupFormValidation();
});