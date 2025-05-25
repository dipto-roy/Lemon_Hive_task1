<?php
// যদি $page বা $totalPages না থাকে তাহলে ডিফল্ট দিন
$page = $page ?? 1;
$totalPages = $totalPages ?? 1;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>DIP Blog</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="styles.css" />
</head>
<body class="bg-gray-50">
    <header class="flex flex-col sm:flex-row justify-between px-4 sm:px-6 bg-gray-800 items-center text-white py-3">
        <a href="index.php" class="text-2xl font-bold tracking-tight mb-2 sm:mb-0"><span class="text-blue-400">DIP</span> Blog</a>
        <nav>
            <ul class="flex gap-4 sm:gap-6">
                <li><a href="index.php" class="hover:text-blue-300 transition">Home</a></li>
                <li><a href="login.php" class="hover:text-blue-300 transition">Admin</a></li>
            </ul>
        </nav>
    </header>

    <section class="max-w-3xl mx-auto pt-10 pb-8 px-4 text-center">
        <h1 class="text-3xl sm:text-4xl font-bold mb-3"><span class="text-blue-500">Welcome to DIP Blog!</span></h1>
        <p class="text-base sm:text-lg text-gray-600">Discover Stories, Guides, and Travel Inspiration From Around Bangladesh.<br> Start Exploring Bangladesh Today!</p>
    </section>

    <main class="max-w-5xl mx-auto px-2 sm:px-4">
        <h2 class="text-xl sm:text-2xl font-semibold mb-5 sm:mb-6 px-1">Latest Posts</h2>
        <div id="blog-list" class="grid gap-6 sm:gap-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">

            <?php if (empty($posts)): ?>
                <p class="text-center col-span-full">No posts found.</p>
            <?php else: ?>
                <?php foreach ($posts as $post): ?>
                <article class="bg-white rounded-2xl shadow p-3 sm:p-4 flex flex-col">
                    <img src="../uploads/<?= htmlspecialchars($post['image']) ?>" alt="<?= htmlspecialchars($post['title']) ?>" class="rounded-xl mb-3 h-40 sm:h-48 w-full object-cover" />
                    <h3 class="text-lg sm:text-xl font-semibold mb-1"><?= htmlspecialchars($post['title']) ?></h3>
                    <p class="text-gray-600 mb-2 text-sm sm:text-base">
                        <?= htmlspecialchars(strlen($post['description']) > 150 ? substr($post['description'], 0, 150) . '...' : $post['description']) ?>
                    </p>
                    <a href="blog.php?id=<?= $post['id'] ?>" class="mt-auto text-blue-600 hover:underline text-sm sm:text-base">Read more</a>
                </article>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>

        <!-- Pagination Controls -->
        <div class="flex justify-center items-center gap-2 sm:gap-3 my-8 sm:my-10">
            <button
    class="px-2 sm:px-3 py-1 rounded bg-gray-200 text-gray-700 hover:bg-gray-300 disabled:opacity-50 text-sm sm:text-base"
    <?= $page <= 1 ? 'disabled' : '' ?>
    onclick="window.location.href='?page=<?= max($page - 1, 1) ?>'"
>
    Prev
</button>
<span class="text-sm sm:text-base">Page <?= $page ?> of <?= $totalPages ?></span>
<button
    class="px-2 sm:px-3 py-1 rounded bg-gray-200 text-gray-700 hover:bg-gray-300 text-sm sm:text-base"
    <?= $page >= $totalPages ? 'disabled' : '' ?>
    onclick="window.location.href='?page=<?= min($page + 1, $totalPages) ?>'"
>
    Next
</button>
        </div>
    </main>

    <footer class="text-center mt-10 sm:mt-20 py-6 sm:py-8 border-t border-gray-200 text-gray-600">
        <div class="flex justify-center gap-4 text-xl sm:text-2xl mb-2">
            <a href="#" aria-label="Facebook" class="hover:text-blue-600"><i class="fa-brands fa-facebook"></i></a>
            <a href="#" aria-label="Instagram" class="hover:text-pink-500"><i class="fa-brands fa-instagram"></i></a>
            <a href="#" aria-label="Twitter" class="hover:text-blue-400"><i class="fa-brands fa-twitter"></i></a>
            <a href="#" aria-label="WhatsApp" class="hover:text-green-500"><i class="fa-brands fa-whatsapp"></i></a>
        </div>
        <p class="font-medium text-sm sm:text-base">&copy; 2025 DIP Blog. All Rights Reserved.</p>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" crossorigin="anonymous"></script>
</body>
</html>
