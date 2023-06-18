<!doctype html>
<html lang="!">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog ~ Registration</title>
    @vite('resources/css/app.css')
</head>
<body>
<div class="flex justify-center items-center h-screen bg-gray-900 font-montserrat">
    <div class="w-1/3 bg-gray-800 shadow-md rounded px-8 py-6">
        <h2 class="text-2xl font-bold text-white mb-6">Registration</h2>
        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-white mb-2 font-medium">Name</label>
                <input type="text" name="name" id="name" class="w-full bg-gray-700 text-white border border-gray-600 rounded px-3 py-2" value="{{old('name')}}" required>
                @error('name')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-white mb-2 font-medium">Email</label>
                <input type="email" name="email" id="email" class="w-full bg-gray-700 text-white border border-gray-600 rounded px-3 py-2" value="{{old('email')}}" required>
                @error('email')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image" class="text-white font-medium">Avatar</label>
                <input type="file" name="image" id="image" class="w-full bg-gray-700 text-white border border-gray-600 rounded px-3 py-2 text-sm cursor-pointer">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-white mb-2 font-medium">Password</label>
                <input type="password" name="password" id="password" class="w-full bg-gray-700 text-white border border-gray-600 rounded px-3 py-2" required>
                @error('password')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-white mb-2 font-medium">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full bg-gray-700 text-white border border-gray-600 rounded px-3 py-2" required>
                @error('password_confirmation')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-6">
                <button type="submit" class="w-full bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">
                    Register
                </button>
            </div>

            <p class="text-gray-300 text-sm text-center">
                Already have an account? <a href="{{ route('loginPage') }}" class="text-orange-500 hover:text-white">Login</a>
            </p>
        </form>
    </div>
</div>
</body>
</html>
