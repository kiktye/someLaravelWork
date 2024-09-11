<x-layout>

    @if (session('status'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400">
            <span class="font-medium"> {{ session('status') }} </span>
        </div>
    @endif

    <x-panel class="p-10">

        <div class="flex flex-col items-center w-[80%] mx-auto">
            <x-discussion-image :discussion="$discussion" width="600" />

            <div class="self-start text-xl font-bold mt-5">
                {{ $discussion->title }}
            </div>

            <div class="mt-3 self-start">
                <p class="text-sm font-medium">
                    {{ $discussion->description }}
                </p>
            </div>

            <p class="text-sm text-gray-400 mt-5">
                {{ $discussion->category->name }} | {{ $discussion->user->username }}
            </p>
        </div>


    </x-panel>

    <div class="flex flex-col py-10">
        <x-page-heading> Comments: </x-page-heading>

        <div class="space-y-6">
            @foreach ($discussion->comments as $comment)
                <x-panel class="flex gap-x-6 items-center">
                    <div class="flex-1 flex flex-col">
                        <h3 class="font-bold text-xl mt-2">
                            {{ $comment->user->username }} says:
                        </h3>

                        <p class="text-sm text-gray">{{ $comment->content }}</p>
                    </div>

                    <div class="flex flex-col items-end">
                        <p class="text-sm text-gray-400">
                            {{ $comment->created_at }}
                        </p>



                        <div>
                            @if (Auth::check() && Auth::user()->id === $comment->user_id)

                                <a href="{{ route('comments.edit', $comment->id) }} "><i class="fa-regular fa-pen-to-square"></i></a>

                                <x-forms.form action="{{ route('comments.destroy', $comment->id) }}" method="POST"
                                    style="display:inline;" class="space-y-0"
                                    onsubmit="return confirm('Are you sure you want to delete your comment?');">
                                    @method('DELETE')
                                    <button type="submit" style="border:none; background:none;">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </x-forms.form>
                            @endif
                        </div>

                    </div>
                </x-panel>
            @endforeach
        </div>
    </div>

    @auth
        <a href="{{ route('comments.create', $discussion) }}"
            class="bg-gray-800 rounded py-2 px-6 text-white font-medium">Add
            Comment</a>
    @endauth

    @guest
        <div class="flex justify-start align-self-center">
            <div>
                <p>You need to log in to add a comment!</p>
            </div>
        </div>
    @endguest

</x-layout>
