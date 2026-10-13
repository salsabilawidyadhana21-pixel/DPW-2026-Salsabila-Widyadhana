// Mengambil data produk dari file JSON
async function loadDataProduk() {
    var tbody = document.querySelector(".table-responsive table tbody");
    var loading = document.getElementById("loading-indicator");

    if (!tbody) return;

    if (loading) loading.style.display = "block";
    tbody.innerHTML = "";

    try {
        // Simulasi loading sebentar
        await new Promise(function (res) {
            setTimeout(res, 500);
        });

        var res = await fetch("../data/produk.json");
        if (!res.ok) {
            throw new Error("HTTP error! status: " + res.status);
        }

        var data = await res.json();

        data.forEach(function (item) {
            var tr = document.createElement("tr");
            tr.innerHTML =
                "<td>" + item.nama_produk + "</td>" +
                "<td>" + item.kategori + "</td>" +
                "<td>Rp " + item.harga + "</td>" +
                "<td>" + item.stok + "</td>" +
                 "<td>" + item.diskon + "</td>" +
                "<td>" +
                "<button type='button'>Edit</button> " +
                "<button type='button' class='btn-hapus'>Hapus</button>" +
                "</td>";

            tbody.appendChild(tr);
        });

    } catch (err) {
        tbody.innerHTML = "<tr><td colspan='5'>Gagal memuat data: " + err.message + "</td></tr>";
    } finally {
        if (loading) loading.style.display = "none";
    }
}

document.addEventListener("DOMContentLoaded", loadDataProduk);