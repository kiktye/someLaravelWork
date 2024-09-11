<x-layout>
    <x-page-heading>Unapproved Discussions</x-page-heading>

    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400">
            <span class="font-medium"> {{ session('success') }} </span>
        </div>
    @endif

    <a href="/" class="bg-blue-500 rounded-xl py-2 px-6 text-white font-semibold"> <- Forum</a>


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
                        <p>No discussions awaiting approval.</p>
                    </div>
                </div>
            @endif
</x-layout>
