<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Create Post</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-6 font-sans max-w-2xl mx-auto">

<h1 class="text-3xl font-bold mb-6">Create New Blog Post</h1>

<?php if (!empty($errors)): ?>
  <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
    <ul>
      <?php foreach ($errors as $error): ?>
        <li>- <?= htmlspecialchars($error) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<form action="/lemon_hive/Lemon_Hive_task1/public/create_post.php" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
  <div class="mb-4">
    <label for="title" class="block mb-1 font-semibold">Title</label>
    <input
      type="text"
      id="title"
      name="title"
      value="<?= htmlspecialchars($postData['title'] ?? '') ?>"
      required
      class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
    />
  </div>

  <div class="mb-4">
    <label for="description" class="block mb-1 font-semibold">Description</label>
    <textarea
      id="description"
      name="description"
      required
      rows="6"
      class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
    ><?= htmlspecialchars($postData['description'] ?? '') ?></textarea>
  </div>

  <div class="mb-4">
    <label for="image" class="block mb-1 font-semibold">Featured Image (JPG, JPEG, PNG)</label>
    <input
      type="file"
      id="image"
      name="image"
      accept=".jpg,.jpeg,.png"
      required
      class="w-full"
    />
  </div>

  <button
    type="submit"
    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded font-semibold"
  >
    Create Post
  </button>
</form>

<p class="mt-6"><a href="../public/index.php" class="text-blue-600 hover:underline">&larr; Back to Blog List</a></p>

</body>
</html>
