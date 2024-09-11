<x-layout>

    <x-page-heading>Welcome to the Forum</x-page-heading>

    {{-- Alerts --}}
    @if (session('status'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400">
            <span class="font-medium"> {{ session('status') }} </span>
        </div>
    @endif

    @if (session('approval'))
        <div class="p-4 text-sm text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300">
            <span class="font-medium"> {{ session('approval') }} </span>
        </div>
    @endif

    @if (session('deletion'))
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">
            <span class="font-medium"> {{ session('deletion') }} </span>
        </div>
    @endif

    @if (session('error'))
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">
            <span class="font-medium"> {{ session('error') }} </span>
        </div>
    @endif


    <div class="flex flex-col w-[25%] space-y-2 text-center mt-3">
        <a href="/discussions/create" class="bg-gray-800 rounded-xl py-2 px-6 text-white font-semibold">Add new
            discussion</a>

        @if (Auth::check() && Auth::user()->is_admin)
            <a href="{{ route('discussions.unapproved') }}"
                class="bg-blue-500 rounded-xl py-2 px-6 text-white font-semibold">Approve
                discussions</a>
        @endif
    </div>

    @if (count($discussions) > 0)
        <section>
            <div class="mt-6 space-y-6">
                @foreach ($discussions as $discussion)
                    <x-discussion-card :discussion="$discussion" />
                @endforeach
            </div>
        </section>
    @else
        <div class="flex justify-center align-self-center py-10">
            <div>
                <p>Nothing here yet! Start a topic!</p>
            </div>
        </div>
    @endif

</x-layout>
