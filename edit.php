<?php
require __DIR__ . '/config/db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: index.php');
    exit;
}

// fetch existing
$stmt = $pdo->prepare('SELECT * FROM contacts WHERE id = ?');
$stmt->execute([$id]);
$contact = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$contact) {
    header('Location: index.php');
    exit;
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');

    if ($name === '') {
        $errors[] = 'Name is required.';
    }
    if ($email === '') {
        $errors[] = 'Email is required.';
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare('UPDATE contacts SET name = ?, email = ?, phone = ? WHERE id = ?');
        $stmt->execute([$name, $email, $phone, $id]);
        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Contact</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="max-w-screen-lg mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Contact</h1>
    <?php if ($errors): ?>
        <ul class="mb-4 text-red-600">
            <?php foreach ($errors as $e): ?>
                <li><?= htmlspecialchars($e) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <form method="POST" class="space-y-4">
        <div>
            <label class="block font-medium">Name</label>
            <input type="text" name="name" class="w-full border rounded px-3 py-2" value="<?= htmlspecialchars($_POST['name'] ?? $contact['name']) ?>">
        </div>
        <div>
            <label class="block font-medium">Email</label>
            <input type="email" name="email" class="w-full border rounded px-3 py-2" value="<?= htmlspecialchars($_POST['email'] ?? $contact['email']) ?>">
        </div>
        <div>
            <label class="block font-medium">Phone</label>
            <input type="text" name="phone" class="w-full border rounded px-3 py-2" value="<?= htmlspecialchars($_POST['phone'] ?? $contact['phone']) ?>">
        </div>
        <div class="flex space-x-2">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
            <a href="index.php" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Cancel</a>
        </div>
    </form>
</div>
</body>
</html>
