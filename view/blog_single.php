<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= htmlspecialchars($post['title']) ?> - DIP Blog</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-6 max-w-3xl mx-auto font-sans">

    <article class="bg-white rounded-2xl shadow p-6">
        <h1 class="text-3xl font-bold mb-4"><?= htmlspecialchars($post['title']) ?></h1>
        <img src="../uploads/<?= htmlspecialchars($post['image']) ?>" alt="<?= htmlspecialchars($post['title']) ?>" class="rounded-lg mb-6 w-full object-cover max-h-96" />
        <p class="text-gray-700 leading-relaxed"><?= nl2br(htmlspecialchars($post['description'])) ?></p>
    </article>

    <p class="mt-6"><a href="index.php" class="text-blue-600 hover:underline">&larr; Back to Blog List</a></p>

</body>
</html>
