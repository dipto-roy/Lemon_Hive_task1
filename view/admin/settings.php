<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Settings - DIP Blog Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-6 font-sans max-w-lg mx-auto">
  <h1 class="text-3xl font-bold mb-6">Settings</h1>

  <?php if (!empty($errors)): ?>
    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
      <ul>
        <?php foreach ($errors as $error): ?>
          <li><?= htmlspecialchars($error) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php elseif (isset($_GET['success'])): ?>
    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
      Settings updated successfully!
    </div>
  <?php endif; ?>

  <form action="settings.php" method="POST" class="bg-white p-6 rounded shadow">
    <label for="posts_per_page" class="block font-semibold mb-2">Posts Per Page</label>
    <input
      type="number"
      id="posts_per_page"
      name="posts_per_page"
      min="1"
      value="<?= htmlspecialchars($postsPerPage ?? 5) ?>"
      required
      class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
    />
    <button
      type="submit"
      class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded font-semibold"
    >
      Save
    </button>
  </form>
</body>
</html>
