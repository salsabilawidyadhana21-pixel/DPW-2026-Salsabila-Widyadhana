// ===== Hamburger Menu =====
function initNavToggle() {
    const toggleBtn = document.getElementById("nav-toggle-btn");
    const nav = document.querySelector("header nav");

    if (!toggleBtn || !nav) return;

    toggleBtn.addEventListener("click", function () {
        nav.classList.toggle("nav-open");
    });
}


// ===== Konfirmasi Hapus =====
// Konfirmasi dilakukan sebelum form POST dikirim.
function initHapusConfirm() {
    const forms = document.querySelectorAll(".form-hapus");

    forms.forEach(function (form) {
        form.addEventListener("submit", function (event) {
            const yakin = confirm(
                "Yakin ingin menghapus data ini?"
            );

            if (!yakin) {
                event.preventDefault();
            }
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

    if (!form) return;

    form.addEventListener("submit", function (event) {

        let valid = true;

        const nama = form.querySelector(
            "[name='judul'], [name='nama']"
        );

        if (nama && nama.value.trim() === "") {
            tampilkanError(
                nama,
                "Field ini wajib diisi."
            );

            valid = false;
        } else if (nama) {
            hapusError(nama);
        }


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


        const stok = form.querySelector(
            "[name='stok']"
        );

        if (stok) {
            const nilai = parseInt(
                stok.value,
                10
            );

            if (isNaN(nilai) || nilai < 0) {
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


// ===== Jalankan Semua Fungsi =====
document.addEventListener(
    "DOMContentLoaded",
    function () {
        initNavToggle();
        initHapusConfirm();
        initValidasiForm();
    }
);