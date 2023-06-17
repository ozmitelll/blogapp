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
                        <a href="{{ route('home')}}" class="text-yellow-500 hover:text-yellow-700 mr-4">Back to Home</a>

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
<div class="w-2/3 mx-auto mt-8 bg-gray-800 rounded-lg shadow-md p-6">

    <h2 class="text-2xl font-bold text-white mb-4">Add a Comment</h2>
    <form action="{{ route('articles.comment.store', $article) }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="content" class="text-white">Content:</label>
            <textarea name="content" id="content" required class="w-full h-24 bg-gray-700 text-white p-4 rounded-lg mt-2" placeholder="Enter your comment for this article..."></textarea>
        </div>
        <button type="submit" class="px-4 py-2 bg-orange-500 hover:bg-orange-700 text-black rounded-lg">Add Comment</button>
    </form>

    <h2 class="text-2xl font-bold text-white mt-4">Comments</h2>
    <ul class="divide-y divide-gray-600 bg-gray-600 rounded-lg">
        @foreach ($comments as $comment)
            <li class="ml-2 py-4">
                <div class="flex justify-between text-white mb-2">
                    <div>
                        <strong>{{ $comment->author }}</strong>
                        <span class="text-gray-400 ml-2">| {{ $comment->created_at->format('d.m.Y H:i') }}</span>
                    </div>
                    @if (Auth::check() && (Auth::user()->id == $article->user_id || Auth::user()->isAdmin()))
                        <form action="{{ route('articles.comment.destroy', ['article' => $article, 'comment' => $comment]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-6 w-6">
                                    <path fill-rule="evenodd" d="M10 2a8 8 0 100 16A8 8 0 0010 2zm3.707 9.293a1 1 0 01-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 01-1.414-1.414L8.586 10l-2.293-2.293a1 1 0 011.414-1.414L10 8.586l2.293-2.293a1 1 0 011.414 1.414L11.414 10l2.293 2.293z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </form>
                    @endif
                </div>
                <p class="text-white font-extralight mb-2">{{ $comment->content }}</p>
                @if ($comment->replies->count() > 0)
                    <ul>
                        @foreach ($comment->replies as $reply)
                            <li class="mt-3">
                                <strong class="ml-5 text-white">{{ $reply->author }}</strong>
                                <span class="text-gray-400 ml-2">| {{ $comment->created_at->format('d.m.Y H:i') }}</span>
                                <p class="ml-5 text-white font-extralight">{{ $reply->content }}</p>
                            </li>
                        @endforeach
                    </ul>
                @endif
                <p id="replyButton" class="underline hover:text-white w-12 ml-5 text-orange-500" >Reply</p>

                <form id="replyForm" class="hidden mt-4" action="{{ route('articles.comment.reply', ['article' => $article, 'comment' => $comment]) }}" method="POST">
                    @csrf
                    <div class="mb-4 ml-5 mr-7">
                        <label for="content" class="text-white">Your reply:</label>
                        <textarea name="content" id="content" required class="w-full h-24 bg-gray-700 text-white p-4 rounded-lg mt-2" placeholder="Enter your reply..."></textarea>
                    </div>
                    <button type="submit" class="px-4 ml-5 py-2 bg-orange-500 hover:bg-orange-700 text-black rounded-lg">Add Comment</button>
                </form>




            </li>
        @endforeach
    </ul>
</div>
<script>
    // Отримати всі кнопки "Відповісти" та форми відповіді
    const replyButtons = document.querySelectorAll('#replyButton');
    const replyForms = document.querySelectorAll('#replyForm');

    // Додати обробник події для кожної кнопки "Відповісти"
    replyButtons.forEach((button, index) => {
        button.addEventListener('click', () => {
            // Перевірка, чи форма відповіді видима або прихована
            if (replyForms[index].classList.contains('hidden')) {
                replyForms[index].classList.remove('hidden');
            } else {
                replyForms[index].classList.add('hidden');
            }
        });
    });
</script>


</body>
</html>
