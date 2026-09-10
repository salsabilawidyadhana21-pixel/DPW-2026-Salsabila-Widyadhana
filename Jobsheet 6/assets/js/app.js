// ===== Hamburger Menu =====
function initNavToggle() {
    const toggleBtn = document.getElementById("nav-toggle-btn");
    const nav = document.querySelector("header nav");

    if (!toggleBtn || !nav) {
        return;
    }

    toggleBtn.addEventListener("click", function () {
        nav.classList.toggle("nav-open");
    });
}


// ===== Konfirmasi Hapus =====
// Menggunakan event delegation karena tombol Hapus
// dibuat secara dinamis oleh buku.js dan anggota.js.
function initHapusConfirm() {

    document.addEventListener("click", function (event) {

        const tombolHapus = event.target.closest(".btn-hapus");

        if (!tombolHapus) {
            return;
        }

        const row = tombolHapus.closest("tr");

        const namaData = row
            ? row.querySelector("td")?.textContent
            : "data ini";

        const yakin = confirm(
            'Yakin ingin menghapus "' + namaData + '"?'
        );

        if (yakin && row) {
            row.remove();
        }

    });
}


// ===== Filter Tabel =====
function initTableFilter() {

    const input = document.getElementById("search-input");
    const table = document.querySelector(".table-responsive table");

    if (!input || !table) {
        return;
    }

    input.addEventListener("keyup", function () {

        const keyword = input.value.toLowerCase();

        const rows = table.querySelectorAll("tbody tr");

        rows.forEach(function (row) {

            const teks = row.textContent.toLowerCase();

            row.style.display =
                teks.includes(keyword) ? "" : "none";

        });

    });
}


// ===== Menampilkan Error =====
function tampilkanError(input, pesan) {

    hapusError(input);

    const span = document.createElement("span");

    span.className = "error";
    span.textContent = pesan;

    input.insertAdjacentElement("afterend", span);
}


// ===== Menghapus Error =====
function hapusError(input) {

    const nextElement = input.nextElementSibling;

    if (
        nextElement &&
        nextElement.classList.contains("error")
    ) {
        nextElement.remove();
    }
}


// ===== Validasi Form =====
function initValidasiForm() {

    const form = document.getElementById("form-tambah");

    if (!form) {
        return;
    }

    form.addEventListener("submit", function (event) {

        let valid = true;

        // Validasi judul / nama
        const judul = form.querySelector(
            "[name='judul'], [name='nama']"
        );

        if (judul && judul.value.trim() === "") {

            tampilkanError(
                judul,
                "Field ini wajib diisi."
            );

            valid = false;

        } else if (judul) {

            hapusError(judul);

        }


        // Validasi pengarang
        const pengarang = form.querySelector(
            "[name='pengarang']"
        );

        if (
            pengarang &&
            pengarang.value.trim() === ""
        ) {

            tampilkanError(
                pengarang,
                "Pengarang wajib diisi."
            );

            valid = false;

        } else if (pengarang) {

            hapusError(pengarang);

        }


        // Validasi tahun
        const tahun = form.querySelector(
            "[name='tahun']"
        );

        if (tahun) {

            const nilai = parseInt(
                tahun.value,
                10
            );

            if (
                isNaN(nilai) ||
                nilai < 1900 ||
                nilai > 2026
            ) {

                tampilkanError(
                    tahun,
                    "Tahun harus di antara 1900-2026."
                );

                valid = false;

            } else {

                hapusError(tahun);

            }
        }


        // Validasi stok
        const stok = form.querySelector(
            "[name='stok']"
        );

        if (stok) {

            const nilai = parseInt(
                stok.value,
                10
            );

            if (
                isNaN(nilai) ||
                nilai < 0
            ) {

                tampilkanError(
                    stok,
                    "Stok tidak boleh negatif."
                );

                valid = false;

            } else {

                hapusError(stok);

            }
        }


        if (!valid) {
            event.preventDefault();
        }

    });
}


// ===== Jalankan Saat HTML Selesai Dimuat =====
document.addEventListener(
    "DOMContentLoaded",
    function () {

        initNavToggle();
        initHapusConfirm();
        initTableFilter();
        initValidasiForm();

    }
);