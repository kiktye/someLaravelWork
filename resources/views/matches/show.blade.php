<x-layout>

    <div class="flex flex-col">

        <x-page-heading>{{ $match->teamHome->name }} vs. {{ $match->teamAway->name }}</x-page-heading>

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
                            </tr>
                        </thead>
                        <tbody>

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
                                        scheduled for: {{ explode(' ', $match->match_date)[0] }}
                                    @else
                                        finished: {{ explode(' ', $match->match_date)[0] }}
                                    @endif

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                    {{ $match->team_home_score }} - {{ $match->team_away_score }} </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="flex space-x-8 justify-evenly my-10">

            <div>
                <x-page-main> Players for {{ $match->teamHome->name }}: </x-page-main>
                <ul>
                    @foreach ($match->teamHome->players as $player)
                        <li>{{ $player->first_name }} {{ $player->last_name }}</li>
                    @endforeach
                </ul>
            </div>

            <div>
                <x-page-main> Players for {{ $match->teamAway->name }}: </x-page-main>
                <ul>
                    @foreach ($match->teamAway->players as $player)
                        <li>{{ $player->first_name }} {{ $player->last_name }}</li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>

</x-layout>
