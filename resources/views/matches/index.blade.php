<x-layout>

    <div class="flex flex-col">

        @if (session('success'))
            <div class="p-4 text-sm text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300">
                <span class="font-medium"> {{ session('success') }} </span>
            </div>
        @endif

        @if (session('error'))
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">
                <span class="font-medium"> {{ session('error') }} </span>
            </div>
        @endif


        @if (Auth::check() && Auth::user()->is_admin)
            <div class="self-end my-5">
                <a href="{{ route('matches.create') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-gna font-bold py-2 px-4 rounded">Add new Match</a>
            </div>
        @endif

        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden">



                    <table class="min-w-full divide-y divide-gray-200">

                        <thead>
                            <tr class="border border-gray-300">
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Home Team
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Away Team
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Is Played
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Result
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">info
                                </th>
                                @if (Auth::check() && Auth::user()->is_admin)
                                    <th scope="col"
                                        class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Action
                                    </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($matches as $match)
                                <tr class="odd:bg-white even:bg-gray-100 hover:bg-gray-100">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                        {{ $match->teamHome->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                        {{ $match->teamAway->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                        {{ $match->is_played ? 'Yes,' : 'No,' }}

                                        @if ($match->is_played === false)
                                            scheduled for: {{ $match->match_date }}
                                        @else
                                            finished: {{ $match->match_date }}
                                        @endif

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                        {{ $match->team_home_score }} - {{ $match->team_away_score }} </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-500">
                                        <a href="{{ route('matches.show', $match->id) }}">View</a>
                                    </td>

                                    @if (Auth::check() && Auth::user()->is_admin)
                                        <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                            {{-- Edit --}}
                                            <a href=" {{ route('matches.edit', $match->id) }} "><i
                                                    class="fa-regular fa-pen-to-square"></i></a>


                                            {{-- Delete --}}
                                            <x-forms.form action="{{ route('matches.destroy', $match->id) }}"
                                                method="POST" style="display:inline;" class="space-y-0"
                                                onsubmit="return confirm('Are you sure you want to delete this match?');">
                                                @method('DELETE')
                                                <button type="submit" style="border:none; background:none;">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </x-forms.form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-layout>
