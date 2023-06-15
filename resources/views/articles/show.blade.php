<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog | {{$article->title}}</title>
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
    <div class="w-2/3 bg-gray-800 shadow-md rounded-lg flex">
        <div class="w-1/2 p-8">
            @if ($article->image)
                <img src="{{ asset('storage/images/' . $article->image) }}" alt="Picture" class="w-full h-full object-cover rounded-lg">
            @endif
        </div>
        <div class="w-1/2 p-8 flex flex-col justify-between">
            <div>
                <div class="flex justify-end mb-4 text-gray-400 text-sm">
                    {{ $article->created_at->format('d.m.Y H:i') }}
                </div>
                <h2 class="text-2xl font-bold text-white mb-4">{{ $article->title }}</h2>
                <p class="text-lg text-gray-300 mb-4">{{ $article->content }}</p>
                <p class="text-gray-400">Category: {{ $article->category }}</p>
            </div>
            <div class="flex flex-col items-end">
                <div class="mt-auto">
                    <div class="flex justify-end items-center">
                        <a href="{{ route('articles.index', $article) }}" class="text-yellow-500 hover:text-yellow-700 mr-4">Back</a>

                        <a href="{{ route('articles.edit', $article) }}" class="text-orange-500 hover:text-orange-700 mr-4">Edit</a>
                        <form action="{{ route('articles.destroy', $article) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>
