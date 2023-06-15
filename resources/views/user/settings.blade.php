<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog | {{Auth::user()->name}} | Settings</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-900">
<header class="bg-gray-300 text-dark font-montserrat">
    <div class="container ml-24">
        <nav class="flex items-center justify-between px-4 py-2">
            <div>
                <a href="/" class="-m-1.5 p-1.5">
                    <img class="h-8 w-auto" src="https://img.icons8.com/ios/50/000000/destiny-2.png" alt="destiny-2"/>
                </a>
            </div>
            <div class="lg:flex lg:gap-x-12">
                <div class="relative">
                    <a href="/" class="mr-4 hover:text-orange-500">Home</a>
                    <a href="{{route('user.settings')}}" class="mr-4 hover:text-orange-500">Settings</a>
                    <a href="{{ route('articles.index') }}" class="mr-4 hover:text-orange-500">Articles</a>
                </div>
            </div>
            @if(Auth::user()==null)
                <a href="{{route('loginPage')}}" class="text-sm font-semibold leading-6 text-black hover:text-orange-500">Log in <span aria-hidden="true">&rarr;</span></a>
            @else
                <a href="{{route('logout')}}" class="text-sm font-semibold leading-6 text-black hover:text-orange-500">Logout <span aria-hidden="true">&rarr;</span></a>
            @endif
        </nav>
    </div>
</header>
<div class="max-w-7xl mx-auto overflow-hidden w-100">
    <div class="bg-gray-900 py-4 px-6 mt-5">
        <h2 class="text-2xl font-bold text-white">Settings</h2>
    </div>
    <div class="px-6 py-4">
        <form>
            <div class="flex items-center mb-4 mt-5">
                <div class="w-1/4">
                    <label for="name" class="text-white">Name:</label>
                </div>
                <div class="w-3/4">
                    <input type="text" id="name" name="name" class="w-full bg-white-100 rounded-md py-2 px-4 focus:outline-none focus:border-orange-500" required>
                </div>
            </div>

            <div class="flex items-center mb-4 mt-10">
                <div class="w-1/4">
                    <label for="email" class="text-white">Email:</label>
                </div>
                <div class="w-3/4">
                    <input type="email" id="email" name="email" class="w-full bg-white rounded-md py-2 px-4 focus:outline-none focus:border-orange-500" required>
                </div>
            </div>

            <div class="flex items-center mb-4 mt-10">
                <div class="w-1/4">
                    <label for="password" class="text-white">Password:</label>
                </div>
                <div class="w-3/4">
                    <input type="password" id="password" name="password" class="w-full bg-white rounded-md py-2 px-4 focus:outline-none focus:border-orange-500" required>
                </div>
            </div>

            <div class="flex items-center mb-4 mt-10">
                <div class="w-1/4">
                    <label for="confirm_password" class="text-white">Confirm Password:</label>
                </div>
                <div class="w-3/4">
                    <input type="password" id="confirm_password" name="confirm_password" class="w-full bg-white rounded-md py-2 px-4 focus:outline-none focus:border-orange-500" required>
                </div>
            </div>

            <div class="flex items-center mb-4 mt-10">
                <div class="w-1/4">
                    <p class="text-white">Currently session:</p>

                </div>
                <div class="w-3/4">
                    <p class="text-gray-400">Browser: {{$browser}}</p>
                    <p class="text-gray-400">Version: {{ $version }}</p>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update</button>
            </div>
        </form>
    </div>
</div>


</body>
</html>
