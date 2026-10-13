<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Praktikum Desain & Pemrograman Web</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f6f9; color: #333; padding: 2rem; }
        .container { max-width: 900px; margin: 0 auto; background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        h1 { color: #1d5b8a; margin-bottom: 0.5rem; }
        p { color: #666; margin-bottom: 1.5rem; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 1rem; }
        .card { background: #eef4fa; border: 1px solid #d0e1f9; padding: 1.2rem; border-radius: 8px; text-decoration: none; color: #1d5b8a; font-weight: 600; text-align: center; transition: all 0.2s ease; }
        .card:hover { background: #1d5b8a; color: white; transform: translateY(-3px); }
        .active { border-color: #1d5b8a; }
        .disabled { opacity: 0.5; pointer-events: none; background: #f0f0f0; border-color: #ddd; color: #888; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Portal Tugas Praktikum DPW</h1>
        <p>Salsabila Widyadhana &mdash; Daftar Modul Jobsheet</p>
        
        <div class="grid">
            <?php for ($i = 1; $i <= 14; $i++): ?>
                <?php 
                    // Mengarahkan langsung ke folder Jobsheet masing-masing
                    $path = "/Jobsheet" . $i . "/index.php";
                    
                    // Tandai Jobsheet yang sudah aktif (Nanti kalau Jobsheet 13 & 14 selesai, cukup tambahkan angkanya di sini)
                    $isReady = in_array($i, [11, 12]); 
                ?>
                <a href="<?= $path ?>" class="card <?= $isReady ? 'active' : 'disabled' ?>">
                    Jobsheet <?= $i ?>
                    <div style="font-size: 0.75rem; font-weight: normal; margin-top: 4px;">
                        <?= $isReady ? 'Ready' : 'Coming Soon' ?>
                    </div>
                </a>
            <?php endfor; ?>
        </div>
    </div>
</body>
</html>