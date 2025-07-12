{{-- resources/views/landing.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task Manager | Landing</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 antialiased">
    <div id="app">
        <!-- Vue will mount here -->
        <landing-page />
    </div>
</body>
</html>
