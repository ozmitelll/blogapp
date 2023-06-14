<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog | Create article</title>
    @vite('resources/css/app.css')
</head>
<body>
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
                    <a href="/about" class="mr-4 hover:text-orange-500">Settings</a>
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
<div class="flex justify-center items-center h-screen bg-gray-900 font-montserrat">
    <div class="w-1/3 bg-gray-800 shadow-md rounded px-8 py-6">
        <h2 class="text-2xl font-bold text-white mb-6">Create Article</h2>

        @if ($errors->any())
            <div class="bg-red-500 text-white text-center px-4 py-2 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="title" class="text-white">Title:</label>
                <input type="text" name="title" id="title" class="w-full bg-gray-700 text-white border border-gray-600 rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label for="content" class="text-white">Content:</label>
                <textarea name="content" id="content" class="w-full bg-gray-700 text-white border border-gray-600 rounded px-3 py-2" required></textarea>
            </div>

            <div class="mb-4">
                <label for="category" class="text-white">Category:</label>
                <select name="category" id="category" class="w-full bg-gray-700 text-white border border-gray-600 rounded px-3 py-2" required>
                    <option value="animals">Animals</option>
                    <option value="science">Science</option>
                    <option value="cars">Cars</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="image" class="text-white">Picture:</label>
                <input type="file" name="image" id="image" class="w-full bg-gray-700 text-white border border-gray-600 rounded px-3 py-2">
            </div>

            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">Create</button>
        </form>
    </div>
</div>
</body>
</html>
