@props([
    $id
])

<div @class(["w-full rounded-md  text-black", 'bg-green-400' => $done, 'bg-gray-300/35' => !$done,]) >
    <div class="flex flex-wrap items-center gap-2 px-4 py-2">
        <p class="flex-1 capitalize basis-full text-wrap">
            {{$label}}
        </p>
        @auth            
        {{--  --}}
        <form method="POST" action="{{route('todos.eventAction', $id)}}" class="flex justify-center gap-3 basis-full">
           @csrf

            @if (!$done)
            <x-primary-button class="bg-green-600 " name="action" value="edit">
                <x-edit-icon />
            </x-primary-button>
            <x-primary-button name="action" value="checked">
                <x-check-icon />
            </x-primary-button>
            @endif

            <x-danger-button name="action" value="delete">
                <x-close-icon />
            </x-danger-button>
        </form>
        @endauth

    </div>

</div>