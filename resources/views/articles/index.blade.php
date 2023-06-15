<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog | Articles</title>
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
<div class="flex justify-center items-center h-screen bg-gray-900 font-montserrat">
    <div class="w-1/3 bg-gray-800 shadow-md rounded px-8 py-6">
        <h2 class="text-2xl font-bold text-white mb-6">My Articles</h2>

        <a href="{{ route('articles.create') }}" class="block text-white mb-4 underline">Create new article</a>

        @if(session('success'))
            <div class="bg-green-500 text-white text-center px-4 py-2 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        @foreach ($articles as $article)
            <div class="mb-6">
                <h3 class="text-white text-lg font-bold">{{ $article->title }}</h3>
                <p class="text-gray-300">{{ $article->content }}</p>
                <p class="text-gray-300">Category: {{ $article->category }}</p>
                <br>
                <a href="{{ route('articles.show', $article) }}" class="text-orange-500 hover:text-white mr-2">Details</a>
                <a href="{{ route('articles.edit', $article) }}" class="text-orange-500 hover:text-white mr-2">Edit</a>

                <form action="{{ route('articles.destroy', $article) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-orange-500 hover:text-white">Delete</button>
                </form>
            </div>
        @endforeach
    </div>
</div>

</body>
</html>
