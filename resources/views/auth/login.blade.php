<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog ~ Login</title>
    @vite('resources/css/app.css')
</head>
<body>
<div class="flex justify-center items-center h-screen bg-gray-900 font-montserrat">
    <div class="w-1/3 bg-gray-800 shadow-md rounded px-8 py-6">
        @if(session('success'))
            <div class="bg-green-500 text-white text-center px-4 py-2 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->has('login'))
                <div class="bg-yellow-400 text-dark text-center py-2 px-4 mb-4 rounded">
                    {{ $errors->first('login') }}
                </div>
            @endif
        <h2 class="text-2xl font-bold text-white mb-6">Login</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-white mb-2 font-medium">Email</label>
                <input type="email" name="email" id="email" class="w-full bg-gray-700 text-white border border-gray-600 rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-white mb-2 font-medium">Password</label>
                <input type="password" name="password" id="password" class="w-full bg-gray-700 text-white border border-gray-600 rounded px-3 py-2" required>
            </div>

            <div class="mb-6">
                <button type="submit" class="w-full bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">
                    Login
                </button>
            </div>

            <p class="text-gray-300 text-sm text-center">
                Don't have an account? <a href="{{ route('registerPage') }}" class="text-orange-500 hover:text-white">Register</a>
            </p>
        </form>
    </div>
</div>
</body>
</html>
