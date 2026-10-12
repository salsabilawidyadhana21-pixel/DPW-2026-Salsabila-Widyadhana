// Mengambil data pelanggan dari file JSON
async function loadDataPelanggan() {
    var tbody = document.querySelector(".table-responsive table tbody");
    var loading = document.getElementById("loading-indicator");

    if (!tbody) return;

    if (loading) loading.style.display = "block";
    tbody.innerHTML = "";

    try {
        await new Promise(function (res) {
            setTimeout(res, 500);
        });

        var res = await fetch("../data/pelanggan.json");
        if (!res.ok) {
            throw new Error("HTTP error! status: " + res.status);
        }

        var data = await res.json();

        data.forEach(function (item) {
            var tr = document.createElement("tr");
            tr.innerHTML =
                "<td>" + item.id_pelanggan + "</td>" +
                "<td>" + item.nama + "</td>" +
                "<td>" + item.kota + "</td>" +
                "<td>" + item.no_hp + "</td>" +
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

document.addEventListener("DOMContentLoaded", loadDataPelanggan);