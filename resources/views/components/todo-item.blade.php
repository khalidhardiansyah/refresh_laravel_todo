@props([
    $id
])

<div @class(["w-full rounded-md  text-black", 'bg-green-400' => $done, 'bg-gray-300/35' => !$done,]) >
    <div class="flex flex-wrap items-center gap-2 px-4 py-2">
        <p class="flex-1 capitalize basis-full text-wrap">
            {{$label}}
        </p>
        @auth           
        <div class="flex justify-center gap-1 basis-full">
            @if (!$done)
            <x-primary-button onclick="window.location='{{route('todos.show', $id)}}'"  type="button" class="bg-green-600 " name="action" value="edit">
                <x-edit-icon />
            </x-primary-button>
            @endif
            <form method="POST"  action="{{route('todos.eventAction', $id)}}">
                @csrf
     
                 @if (!$done)
                
                 
                 <x-primary-button name="action" value="checked">
                     <x-check-icon />
                 </x-primary-button>
                 @endif
     
                 <x-danger-button name="action" value="delete">
                     <x-close-icon />
                 </x-danger-button>
             </form>
        </div> 
        @endauth

    </div>



</div>