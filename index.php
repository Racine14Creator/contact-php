<?php
require __DIR__ . '/config/db.php';

// fetch all contacts
$stmt = $pdo->query('SELECT * FROM contacts ORDER BY id DESC');
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="max-w-screen-lg mx-auto p-6">
    <h1 class="text-3xl font-bold mb-4">Contacts</h1>
    <p class="mb-4"><a class="inline-block bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded" href="create.php">Add New Contact</a></p>
    <?php if (count($contacts) === 0): ?>
        <p class="text-gray-700">No contacts found.</p>
    <?php else: ?>
        <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow rounded">
            <thead>
            <tr class="bg-gray-200 text-left">
                <th class="py-2 px-4">ID</th>
                <th class="py-2 px-4">Name</th>
                <th class="py-2 px-4">Email</th>
                <th class="py-2 px-4">Phone</th>
                <th class="py-2 px-4">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($contacts as $c): ?>
                <tr class="border-t">
                    <td class="py-2 px-4"><?= htmlspecialchars($c['id']) ?></td>
                    <td class="py-2 px-4"><?= htmlspecialchars($c['name']) ?></td>
                    <td class="py-2 px-4"><?= htmlspecialchars($c['email']) ?></td>
                    <td class="py-2 px-4"><?= htmlspecialchars($c['phone']) ?></td>
                    <td class="py-2 px-4 space-x-2">
                        <a class="text-blue-500 hover:underline" href="edit.php?id=<?= $c['id'] ?>">Edit</a>
                        <button onclick="showModal(<?= $c['id'] ?>)" class="text-red-500 hover:underline">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/app/partials/delete-modal.php'; ?>

<script>
function showModal(id) {
    const modal = document.getElementById('deleteModal');
    const confirmBtn = document.getElementById('confirmDelete');
    confirmBtn.href = 'delete.php?id=' + id;
    modal.classList.remove('hidden');
}
function hideModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}
</script>
</body>
</html>
