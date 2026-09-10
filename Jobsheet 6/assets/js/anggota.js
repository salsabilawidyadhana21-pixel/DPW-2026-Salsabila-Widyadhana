// ===== Memuat Daftar Anggota dari JSON =====
async function muatDaftarAnggota() {

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
            "../data/anggota.json"
        );

        if (!response.ok) {

            throw new Error(
                "Gagal mengambil data (status " +
                response.status +
                ")"
            );

        }

        // Mengubah JSON menjadi objek JavaScript
        const daftarAnggota =
            await response.json();

        // Menampilkan data ke tabel
        daftarAnggota.forEach(function (anggota) {

            const tr =
                document.createElement("tr");

            tr.innerHTML =
                "<td>" + anggota.no_anggota + "</td>" +
                "<td>" + anggota.nama + "</td>" +
                "<td>" + anggota.alamat + "</td>" +
                "<td>" + anggota.no_hp + "</td>" +
                "<td>" +
                "<button type='button'>Edit</button> " +
                "<button type='button' class='btn-hapus'>Hapus</button>" +
                "</td>";

            tbody.appendChild(tr);

        });

    } catch (error) {

        tbody.innerHTML =
            "<tr>" +
            "<td colspan='5'>" +
            "Gagal memuat data: " +
            error.message +
            "</td>" +
            "</tr>";

    } finally {

        loading.style.display = "none";

    }
}


// Jalankan setelah halaman selesai dimuat
document.addEventListener(
    "DOMContentLoaded",
    muatDaftarAnggota
);