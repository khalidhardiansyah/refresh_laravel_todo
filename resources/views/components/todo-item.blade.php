<div class="w-full rounded-md bg-gray-300/35">
    <div class="flex flex-wrap items-center gap-2 px-4 py-2">
        <p class="flex-1 capitalize basis-full text-wrap">
            {{$label}}
        </p>
        <div class="flex justify-center gap-3 basis-full">
            <x-primary-button class="bg-green-600 ">
                <x-edit-icon />
            </x-primary-button>
            <x-primary-button>
                <x-check-icon />
            </x-primary-button>

            <x-danger-button>
                <x-close-icon />
            </x-danger-button>
        </div>

    </div>

</div>