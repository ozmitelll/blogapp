<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Blog App</title>
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


<div class="grid grid-cols-2 gap-4 mt-8 mx-auto">
    @foreach($articles as $article)
        <div class="bg-gray-800 text-white p-4 rounded-lg shadow-md mt-10 ml-10 mr-10">
            <h2 class="text-xl font-bold mb-2">{{ $article->title }}</h2>
            @if ($article->image)
                <img src="{{ asset('storage/images/' . $article->image) }}" alt="Picture" class="w-full h-64 object-cover rounded-lg mb-2">
            @endif
            <p class="text-gray-300">{{ substr($article->content, 0, 100) }}...</p>
            <p class="text-gray-400">Date: {{ $article->created_at }}</p>
            <a href="{{ route('articles.show', $article->id) }}" class="text-orange-500 hover:text-orange-600">Read More</a>
        </div>
    @endforeach
</div>
<script>
    // JavaScript код
    document.getElementById('avatarButton').addEventListener('click', function() {
        var dropdownMenu = document.getElementById('dropdownMenu');
        dropdownMenu.classList.toggle('hidden');
    });
</script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>
