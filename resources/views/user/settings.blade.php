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
                    <a href="{{ route('articles.index') }}" class="mr-4 hover:text-orange-500">Articles</a>
                </div>
            </div>
            @if(Auth::user()==null)
                <a href="{{route('loginPage')}}" class="text-sm font-semibold leading-6 text-black hover:text-orange-500">Log in <span aria-hidden="true">&rarr;</span></a>
            @else

                <div class="relative">

                    <button id="avatarButton" class="flex items-center focus:outline-none">
                        <p class="mr-5">{{Auth::user()->name}}</p>
                        @if(Auth::user()->avatar != null)
                            <img src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}" alt="" class="w-10 h-10  object-cover rounded-full cursor-pointer" type="button" id="avatarButton" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start">
                        @else
                            <img src="{{asset('storage/avatars/default-avatar.png')}}" alt="" class="w-10 h-10  object-cover rounded-full cursor-pointer" type="button" id="avatarButton" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start">
                        @endif
                    </button>


                    <div id="dropdownMenu" class="absolute right-0 mt-2 py-2 w-48 bg-gray-500 rounded-lg shadow-xl z-10 hidden">
                        <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Profile</a>
                        <a href="{{route('user.settings')}}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Settings</a>
                        <a href="{{route('logout')}}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Logout</a>
                    </div>
                </div>
            @endif
        </nav>
    </div>
</header>
<div class="max-w-7xl mx-auto overflow-hidden w-100">
    <div class="bg-gray-900 py-4 px-6 mt-5">
        <h2 class="text-2xl font-bold text-white">Settings</h2>
    </div>
    @if(session('success'))
        <div class="bg-orange-500 text-white text-center px-4 py-2 mb-4 max-w-7xl rounded">
            {{ session('success') }}
        </div>
    @endif
    <div class="px-6 py-4">
        <form action="{{route('user.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="flex items-center mb-10 mt-5">
                <div class="w-1/4">
                    <label for="image" class="text-white">Avatar:</label>
                </div>
                <div class="w-3/4">
                    <input type="file" name="image" id="image" class="w-full bg-gray-700 text-white border border-gray-600 rounded px-3 py-2 text-sm cursor-pointer">
                    @error('image')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>


            <div class="flex items-center mb-4 mt-5">
                <div class="w-1/4">
                    <label for="name" class="text-white">Name:</label>
                </div>
                <div class="w-3/4">
                    <input type="text"  id="name" name="name" value="{{ old('name', $user->name) }}" class="w-full bg-white-100 rounded-md py-2 px-4 focus:outline-none focus:border-orange-500" required>
                    @error('name')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center mb-4 mt-10">
                <div class="w-1/4">
                    <label for="email" class="text-white">Email:</label>
                </div>
                <div class="w-3/4">
                    <input type="email"  id="email" name="email" value="{{ old('email', $user->email) }}" class="w-full bg-white rounded-md py-2 px-4 focus:outline-none focus:border-orange-500" required>
                    @error('email')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center mb-4 mt-10">
                <div class="w-1/4">
                    <label for="password" class="text-white">Password:</label>
                </div>
                <div class="w-3/4">
                    <input type="password" id="password" name="password" class="w-full bg-white rounded-md py-2 px-4 focus:outline-none focus:border-orange-500">
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
