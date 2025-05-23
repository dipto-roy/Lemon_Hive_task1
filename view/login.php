<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login - DIP Blog Admin</title>
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Manrope font -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
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
<body class="bg-gray-50 min-h-screen flex items-center justify-center px-4">
  <main
    class="bg-white rounded-2xl shadow-lg w-full max-w-md p-8 sm:p-10"
    role="main"
    aria-labelledby="login-title"
  >
    <h1
      id="login-title"
      class="text-3xl font-bold text-gray-900 mb-6 text-center"
    >
      Admin Login
    </h1>

    <form action="login.php" method="POST" novalidate>
      <div class="mb-5">
        <label
          for="username"
          class="block text-gray-700 font-semibold mb-2"
          >Username</label
        >
        <input
          type="text"
          id="username"
          name="username"
          required
          autofocus
          autocomplete="username"
          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
          placeholder="Enter username"
          aria-describedby="username-error"
        />
        <p
          id="username-error"
          class="mt-1 text-red-600 text-sm hidden"
          aria-live="polite"
        ></p>
      </div>

      <div class="mb-6">
        <label
          for="password"
          class="block text-gray-700 font-semibold mb-2"
          >Password</label
        >
        <input
          type="password"
          id="password"
          name="password"
          required
          autocomplete="current-password"
          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
          placeholder="Enter password"
          aria-describedby="password-error"
        />
        <p
          id="password-error"
          class="mt-1 text-red-600 text-sm hidden"
          aria-live="polite"
        ></p>
      </div>

      <button
        type="submit"
        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1"
      >
        Log In
      </button>
    </form>
  </main>
</body>
</html>
