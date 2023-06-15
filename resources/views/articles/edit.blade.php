<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog | {{$article->title}} | Edit</title>
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
    <div class="w-2/3 bg-gray-800 shadow-md rounded-lg">
        <div class="p-8 flex">
            <div class="w-1/3 pr-4 flex items-center">
                @if ($article->image)
                    <div class="mb-4">
                        <label class="text-white">Picture now:</label>
                        <img src="{{ asset('storage/images/' . $article->image) }}" alt="Picture"
                             class="w-full rounded-md">
                    </div>
                @endif
            </div>
            <div class="w-2/3">
                <h2 class="text-2xl font-bold text-white mb-4">Edit article</h2>

                @if ($errors->any())
                    <div class="bg-red-500 text-white text-center px-4 py-2 mb-4 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('articles.update', $article) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="title" class="text-white">Title:</label>
                        <input type="text" name="title" id="title" value="{{ $article->title }}" required
                               class="w-full bg-gray-700 text-white border border-gray-600 rounded-md p-2">
                    </div>

                    <div class="mb-4">
                        <label for="content" class="text-white">Content:</label>
                        <textarea name="content" id="content" required
                                  class="w-full bg-gray-700 text-white border border-gray-600 rounded-md p-2">{{ $article->content }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="category" class="text-white">Category:</label>
                        <select name="category" id="category" required
                                class="w-full bg-gray-700 text-white border border-gray-600 rounded-md p-2">
                            <option value="animals" {{ $article->category === 'animals' ? 'selected' : '' }}>
                                Animals</option>
                            <option value="science" {{ $article->category === 'science' ? 'selected' : '' }}>
                                Science</option>
                            <option value="cars" {{ $article->category === 'cars' ? 'selected' : '' }}>
                                Cars</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="image" class="text-white">Picture:</label>
                        <input type="file" name="image" id="image"
                               class="w-full bg-gray-700 text-white border border-gray-600 rounded-md p-2">
                    </div>

                    <button type="submit" class="text-yellow-500 hover:text-yellow-700">Update</button>
                    <a href="{{ route('articles.index', $article) }}" class="text-yellow-500 hover:text-yellow-700 ml-5">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
