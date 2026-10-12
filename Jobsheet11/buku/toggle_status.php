<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/koneksi.php';

$id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);
$status = ($_GET['status'] ?? '') === 'Nonaktif' ? 'Nonaktif' : 'Aktif';

if ($id) {
    $stmt = $pdo->prepare("UPDATE buku SET status = :status WHERE id = :id");
    $stmt->execute([
        'status' => $status,
        'id'     => $id
    ]);
    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Status buku berhasil diperbarui.'];
}

header('Location: list.php');
exit;
?>