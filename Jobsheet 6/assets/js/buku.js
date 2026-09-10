// ===== Memuat Daftar Buku dari JSON =====
async function muatDaftarBuku() {

    const tbody = document.querySelector(
        ".table-responsive table tbody"
    );

    const loading = document.getElementById(
        "loading-indicator"
    );

    if (!tbody) {
        return;
    }

    // Tampilkan loading
    loading.style.display = "block";

    // Kosongkan tabel
    tbody.innerHTML = "";

    try {

        // Simulasi proses jaringan
        await new Promise(function (resolve) {
            setTimeout(resolve, 600);
        });

        // Mengambil data JSON
        const response = await fetch(
            "../data/buku.json"
        );

        // Periksa response
        if (!response.ok) {
            throw new Error(
                "Gagal mengambil data (status " +
                response.status +
                ")"
            );
        }

        // Mengubah JSON menjadi objek JavaScript
        const daftarBuku = await response.json();

        // Menampilkan data ke tabel
        daftarBuku.forEach(function (buku) {

            const tr = document.createElement("tr");

            tr.innerHTML =
                "<td>" + buku.judul + "</td>" +
                "<td>" + buku.pengarang + "</td>" +
                "<td>" + buku.tahun + "</td>" +
                "<td>" + buku.stok + "</td>" +
                "<td>" +
                "<button type='button'>Edit</button> " +
                "<button type='button' class='btn-hapus'>Hapus</button>" +
                "</td>";

            tbody.appendChild(tr);

        });

    } catch (error) {

        // Menampilkan pesan jika terjadi error
        tbody.innerHTML =
            "<tr>" +
            "<td colspan='5'>" +
            "Gagal memuat data: " +
            error.message +
            "</td>" +
            "</tr>";

    } finally {

        // Sembunyikan loading
        loading.style.display = "none";

    }
}


// Jalankan ketika halaman selesai dimuat
document.addEventListener(
    "DOMContentLoaded",
    muatDaftarBuku
);