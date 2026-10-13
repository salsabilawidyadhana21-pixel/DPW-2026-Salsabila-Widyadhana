<?php
$page_title = "Beranda";
include __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/koneksi.php';

// Ambil data ringkasan real-time
$totalBuku = (int) $pdo->query("SELECT COUNT(*) FROM buku")->fetchColumn();

$totalAnggota = 0;
try {
    $totalAnggota = (int) $pdo->query("SELECT COUNT(*) FROM anggota")->fetchColumn();
} catch (Exception $e) {
    $totalAnggota = 0;
}

$totalPinjam = 0;
try {
    $totalPinjam = (int) $pdo->query("SELECT COUNT(*) FROM peminjaman WHERE status = 'dipinjam'")->fetchColumn();
} catch (Exception $e) {
    $totalPinjam = 0;
}
?>

<!-- Load Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    .welcome-card {
        background: #ffffff;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        margin-bottom: 1.5rem;
    }
    .welcome-card h2 {
        color: #1d5b8a;
        margin-bottom: 0.5rem;
        font-size: 1.6rem;
    }
    .welcome-card p {
        color: #555;
        font-size: 0.95rem;
    }

    .stats-container {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 1.5rem;
    }

    @media (max-width: 768px) {
        .stats-container {
            grid-template-columns: 1fr;
        }
    }

    .stats-cards {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .stat-card-item {
        background: #ffffff;
        padding: 1.25rem 1.5rem;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        border-left: 5px solid #1d5b8a;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .stat-card-item h4 {
        color: #555;
        font-size: 0.9rem;
        margin: 0;
    }
    .stat-card-item p {
        color: #1d5b8a;
        font-size: 1.8rem;
        font-weight: bold;
        margin: 0;
    }

    .chart-card {
        background: #ffffff;
        padding: 1.5rem;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    }
    .chart-card h3 {
        color: #1d5b8a;
        font-size: 1.1rem;
        margin-bottom: 1rem;
    }
</style>

<div class="welcome-card">
    <h2>Selamat Datang di Sistem Perpustakaan Mini</h2>
    <p>Aplikasi sederhana untuk mengelola data buku dan anggota perpustakaan.</p>
</div>

<div class="stats-container">
    <!-- Stat Cards Ringkasan -->
    <div class="stats-cards">
        <div class="stat-card-item" style="border-left-color: #1d5b8a;">
            <div>
                <h4>Total Buku</h4>
                <p><?php echo $totalBuku; ?></p>
            </div>
        </div>
        <div class="stat-card-item" style="border-left-color: #28a745;">
            <div>
                <h4>Total Anggota</h4>
                <p><?php echo $totalAnggota; ?></p>
            </div>
        </div>
        <div class="stat-card-item" style="border-left-color: #ffc107;">
            <div>
                <h4>Sedang Dipinjam</h4>
                <p><?php echo $totalPinjam; ?></p>
            </div>
        </div>
    </div>

    <!-- Chart Grafik Visual -->
    <div class="chart-card">
        <h3>Grafik Ringkasan Data</h3>
        <div style="position: relative; height: 220px; width: 100%;">
            <canvas id="summaryChart"></canvas>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('summaryChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Total Buku', 'Total Anggota', 'Sedang Dipinjam'],
                datasets: [{
                    label: 'Jumlah',
                    data: [<?php echo $totalBuku; ?>, <?php echo $totalAnggota; ?>, <?php echo $totalPinjam; ?>],
                    backgroundColor: [
                        'rgba(29, 91, 138, 0.85)',
                        'rgba(40, 167, 69, 0.85)',
                        'rgba(255, 193, 7, 0.85)'
                    ],
                    borderColor: [
                        '#1d5b8a',
                        '#28a745',
                        '#ffc107'
                    ],
                    borderWidth: 1,
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    });
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>