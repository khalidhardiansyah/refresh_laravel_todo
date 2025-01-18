@php
    $open = false
@endphp
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

<body class="font-sans antialiased">
    <div class="grid w-full px-6 py-10 space-y-3 bg-gray-500 min-h-dvh sm:place-content-center text-black/80">
        <div class="w-full space-y-3">

            <h1 class="mb-5 text-3xl text-center">All Todo List</h1>

            <form method="POST" action="{{ $todo ? route('todos.update', $todo->id) : route('todos.store') }}">

                @if ($todo)
                    @method('PATCH')
                @endif
                @csrf
                <x-text-input type="text" name="activity" placeholder="Masukan aktivitas"
                    value="{{ old('todo', $todo ? $todo->todo : '') }}" />
              
                    <x-primary-button type="submit">
                        submit
                    </x-primary-button>

                    
                
                
               
                

                <x-input-error :messages="$errors->all()" />
            </form>
            
            @auth
                
            <form action="{{route('logout')}}" method="post">
                @csrf
                <x-danger-button type="submit">
                    logout
                </x-danger-button> 
            </form>
            @endauth

            <div
                class="flex flex-col items-stretch min-w-full p-5 overflow-y-auto bg-blue-300 rounded-md sm:min-h-64 max-h-80 sm:min-w-96 max-w-96 gap-y-4">
                <ul class="space-y-4">


                   @auth                   
                   @if ($todoUser->isEmpty())
                   
                   <span>
                    Belum ada aktivitas
                   </span>
                   
                   @endif
                   @foreach ($todoUser as $item)
                   <x-todo-item :label="$item->todo" :id="$item->id" :done="$item->isDone" class=" basis-full" />
                   @endforeach
                   @endauth  
                   
                    @unless (Auth::check())
                    @foreach ($todos as $item)
                    <x-todo-item :label="$item->todo" :id="$item->id" :done="$item->isDone" class=" basis-full" />
                    @endforeach 
                    @endunless

                    

                    
                </ul>


            </div>
        </div>
    </div>
</body>

</html>
