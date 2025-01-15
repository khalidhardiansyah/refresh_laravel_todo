<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Todo List</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <div class="grid place-content-center bg-gray-50 text-black/80 dark:bg-black dark:text-white/50 min-h-dvh">
        <div class="px-6 py-10 space-y-3">
            
            <h1 class="mb-5 text-3xl text-center">All Todo List</h1>
            <form method="POST" action="{{route('todos.store')}}">
                @csrf
                <x-text-input type="text" name="activity" id="todo" placeholder="Masukan aktivitas" />
                <x-primary-button type="submit">
                    submit
                </x-primary-button>

                <x-input-error :messages="$errors->all()"/>
            </form>

            <div
                class="flex flex-col items-stretch p-5 overflow-scroll bg-blue-300 rounded-md min-h-96 min-w-96 gap-y-4">
                <ul class="space-y-4">
                    @foreach ($todos as $item)
                        <li>
                            <x-todo-item :label="$item->todo" :id="$item->id" :done="$item->isDone" class=" basis-full" />
                        </li>
                    @endforeach
                </ul>


            </div>
        </div>
    </div>
</body>

</html>
