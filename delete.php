<?php
require __DIR__ . '/config/db.php';

$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare('DELETE FROM contacts WHERE id = ?');
    $stmt->execute([$id]);
}
header('Location: index.php');
exit;
