<x-layout>

    <div class="flex flex-col">
        {{-- {{ dd($team) }} --}}
        <x-page-heading>{{ $team->name }} - Founded: {{ $team->year_founded }} </x-page-heading>

        <div class="flex justify-evenly">
            <div>
                <x-page-main>Players: </x-page-main>
                <ul>
                    @foreach ($team->players as $player)
                        <li>{{ $player->first_name }}
                            {{ $player->last_name }}</li>
                    @endforeach
                </ul>
            </div>

            <div>
                <x-page-main>Matches: </x-page-main>
                <ul>
                    @foreach ($team->matchesAsTeamHome as $match)
                        {{-- {{ dd($match) }} --}}
                        <li>{{ $match->teamHome->name }} : {{ $match->teamAway->name }} | Result : {{ $match->team_home_score }} - {{ $match->team_away_score }}</li>
                    @endforeach

                    @foreach ($team->matchesAsTeamAway as $match)
                    {{-- {{ dd($match) }} --}}
                    <li>{{ $match->teamHome->name }} : {{ $match->teamAway->name }} | Result : {{ $match->team_home_score }} - {{ $match->team_away_score }}</li>
                @endforeach
                </ul>
            </div>
        </div>

    </div>

</x-layout>
