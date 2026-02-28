<?php
require __DIR__ . '/config/db.php';

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
        $stmt = $pdo->prepare('INSERT INTO contacts (name, email, phone) VALUES (?, ?, ?)');
        $stmt->execute([$name, $email, $phone]);
        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Contact</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="max-w-screen-lg mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Add New Contact</h1>
    <?php if ($errors): ?>
        <ul class="mb-4 text-red-600">
            <?php foreach ($errors as $e): ?>
                <li class="bg-red-100 p-2 rounded text-red-500 py-5 px-3 my-3"><?= htmlspecialchars($e) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <form method="POST" class="space-y-4">
        <div>
            <label class="block font-medium">Name</label>
            <input type="text" name="name" class="w-full border rounded px-3 py-2" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
        </div>
        <div>
            <label class="block font-medium">Email</label>
            <input type="email" name="email" class="w-full border rounded px-3 py-2" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        </div>
        <div>
            <label class="block font-medium">Phone</label>
            <input type="text" name="phone" class="w-full border rounded px-3 py-2" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
        </div>
        <div class="flex space-x-2">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Save</button>
            <a href="index.php" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Cancel</a>
        </div>
    </form>
</div>
</body>
</html>
