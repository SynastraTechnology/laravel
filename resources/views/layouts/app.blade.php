<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Synastra Starter Kit')</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-900 min-h-screen flex flex-col">


  <header class="bg-white shadow p-4">
    <div class="container mx-auto flex justify-between items-center">
      <a href="/" class="text-xl font-bold">Synastra</a>
      <nav class="space-x-4">
        <a href="/" class="hover:underline">Home</a>
        <a href="/dashboard" class="hover:underline">Dashboard</a>
        <a href="/login" class="hover:underline">Login</a>
      </nav>
    </div>
  </header>


  <main class="flex-1 container mx-auto p-6">
    @yield('content')
  </main>


  <footer class="bg-white shadow p-4 text-center text-sm">
    &copy; 2025 Synastra Starter Kit
  </footer>

</body>
</html>
