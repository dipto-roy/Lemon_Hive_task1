<?php
require_once __DIR__ . '/../../Controller/BlogController.php';
use LH\Controller\BlogController;

// ইউজার অথেনটিকেশন চেক
require_once __DIR__ . '/../../Controller/authc.php';
use LH\Controllers\AuthController;
AuthController::checkAuth();

$controller = new BlogController();
$posts = $controller->getAllPosts();
?>

<?php
require_once __DIR__ . '/../../Controller/BlogController.php';



$controller = new BlogController();
$posts = $controller->listPosts(1, 100);  // পেজ 1, ১০০ পোস্ট (বা আপনার প্রয়োজন অনুযায়ী)
?>


<!DOCTYPE html>
<html lang="en" class="scroll-smooth" >
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Dashboard - DIP Blog</title>
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Manrope font -->
  <link
    href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700&display=swap"
    rel="stylesheet"
  />
  <style>
    body {
      font-family: 'Manrope', sans-serif;
    }
  </style>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

  <!-- Header / Navbar -->
  <header class="bg-gray-800 text-white flex flex-col sm:flex-row items-center justify-between px-4 py-4">
    <h1 class="text-2xl font-bold mb-3 sm:mb-0">Admin Dashboard</h1>
    <nav>
      <ul class="flex gap-4">
        <li><a href="create_blog.php" class="bg-blue-600 hover:bg-blue-700 rounded px-3 py-1 text-sm sm:text-base font-semibold transition">+ Create Post</a></li>
        <li><a href="settings.php" class="hover:underline text-sm sm:text-base">Settings</a></li>
       <!-- <li><a href="logout.php" class="hover:underline text-sm sm:text-base text-red-400">Logout</a></li>-->
        <li><a href="../../public/logout.php" class="hover:underline text-sm sm:text-base text-red-400">Logout</a></li>
      </ul>
    </nav>
  </header>

  <!-- Main Content -->
  <main class="flex-grow container max-w-6xl mx-auto px-4 py-6">
    <h2 class="text-xl font-semibold mb-6">All Blog Posts</h2>

    <div class="overflow-x-auto">
      <table class="min-w-full bg-white rounded-lg shadow divide-y divide-gray-200">
        <thead class="bg-gray-100">
          <tr>
            <th class="px-4 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wide">#</th>
            <th class="px-4 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wide">Title</th>
            <th class="px-4 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wide">Created At</th>
            <th class="px-4 py-3 text-center text-sm font-medium text-gray-700 uppercase tracking-wide">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
  <?php foreach ($posts as $post): ?>
    <tr class="hover:bg-gray-50">
      <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($post['id']) ?></td>
      <td class="px-4 py-3 text-sm text-gray-900 max-w-xs truncate" title="<?= htmlspecialchars($post['title']) ?>">
        <?= htmlspecialchars($post['title']) ?>
      </td>
      <td class="px-4 py-3 text-sm text-gray-600"><?= htmlspecialchars($post['created_at']) ?></td>
      <td class="px-4 py-3 whitespace-nowrap text-center text-sm font-medium space-x-3">
        <a href="edit_post.php?id=<?= $post['id'] ?>" class="text-blue-600 hover:text-blue-800">Edit</a>
        <button
          data-id="<?= $post['id'] ?>"
          class="text-red-600 hover:text-red-800 delete-post-btn"
          aria-label="Delete post <?= htmlspecialchars($post['title']) ?>"
        >Delete</button>
      </td>
    </tr>
  <?php endforeach; ?>
</tbody>

      </table>
    </div>
  </main>

  <!-- Optional: Delete Confirmation Modal -->
  <div
    id="deleteModal"
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden"
    role="dialog"
    aria-modal="true"
    aria-labelledby="modalTitle"
  >
    <div class="bg-white rounded-lg p-6 max-w-sm w-full">
      <h3 id="modalTitle" class="text-lg font-semibold mb-4">Confirm Deletion</h3>
      <p class="mb-6">Are you sure you want to delete this post?</p>
      <div class="flex justify-end space-x-4">
        <button id="cancelBtn" class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">Cancel</button>
        <button id="confirmDeleteBtn" class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">Delete</button>
      </div>
    </div>
  </div>

  <!-- JS for modal and deletion -->
  <script>
    const deleteButtons = document.querySelectorAll('.delete-post-btn');
    const modal = document.getElementById('deleteModal');
    const cancelBtn = document.getElementById('cancelBtn');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    let postIdToDelete = null;

    deleteButtons.forEach(btn => {
      btn.addEventListener('click', () => {
        postIdToDelete = btn.dataset.id;
        modal.classList.remove('hidden');
      });
    });

    cancelBtn.addEventListener('click', () => {
      modal.classList.add('hidden');
      postIdToDelete = null;
    });

    confirmDeleteBtn.addEventListener('click', () => {
      if (!postIdToDelete) return;

      // AJAX delete example (replace URL & method as per your backend)
      fetch(`delete_post.php?id=${postIdToDelete}`, {
        method: 'DELETE',
      })
      .then(res => {
        if (res.ok) {
          // Remove row from table
          const row = document.querySelector(`button[data-id="${postIdToDelete}"]`).closest('tr');
          row.remove();
          modal.classList.add('hidden');
          postIdToDelete = null;
        } else {
          alert('Failed to delete post.');
        }
      })
      .catch(() => alert('Failed to delete post.'));
    });
  </script>

</body>
</html>
