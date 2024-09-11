<x-panel class="flex gap-x-6 items-center">

    <div>
        <x-discussion-image :discussion="$discussion" />
    </div>

    <div class="flex-1 flex flex-col">
        <h3 class="font-bold text-xl mt-2 group-hover:text-blue-800 transition-colors duration-300">
            <a href="{{ route('discussions.show', $discussion) }}">
                {{ $discussion->title }}
            </a>
        </h3>

        <p class="text-xs text-gray-400 text-wrap w-[80%]">{{ $discussion->description }}</p>
    </div>

    <div class="flex flex-col items-end">
        <p class="text-sm text-gray-400">
            {{ $discussion->category->name }} | {{ $discussion->user->username }}
        </p>

        <div>

            @if (Auth::check() && Auth::user()->is_admin)
                @if ($discussion->approved == 0)
                    <a href="{{ route('discussions.approve', $discussion->id) }}"><i class="fa-solid fa-check"></i></a>
                @endif


                <a href=" {{ route('discussions.edit', $discussion->id) }} "><i
                        class="fa-regular fa-pen-to-square"></i></a>


                <x-forms.form action="{{ route('discussions.destroy', $discussion->id) }}" method="POST"
                    style="display:inline;" class="space-y-0"
                    onsubmit="return confirm('Are you sure you want to delete this discussion?');">
                    @method('DELETE')
                    <button type="submit" style="border:none; background:none;">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </x-forms.form>

            @endif

            @if (Auth::check() && Auth::user()->id === $discussion->user_id)
                <a href=" {{ route('discussions.edit', $discussion->id) }} "><i
                        class="fa-regular fa-pen-to-square"></i></a>

                <x-forms.form action="{{ route('discussions.destroy', $discussion->id) }}" method="POST"
                    style="display:inline;" class="space-y-0"
                    onsubmit="return confirm('Are you sure you want to delete this discussion?');">
                    @method('DELETE')
                    <button type="submit" style="border:none; background:none;">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </x-forms.form>
            @endif
        </div>
    </div>
</x-panel>
