<x-layout>

    <div class="flex flex-col">


        <x-page-heading>{{ $player->first_name }} {{ $player->last_name }}</x-page-heading>
        <x-page-main>Date of Birth: {{ $player->birth_date }}</x-page-main>

        <h1 class="text-2xl font-bold">Playing for: {{ $player->team->name }}</h1>

        <h1 class="text-2xl font-bold">Played for matches:</h1>
        @foreach ($player->team->matchesAsTeamHome as $match)
            <li>{{ $match->teamHome->name }} : {{ $match->teamAway->name }} | Date : {{ $match->match_date }} </li>
        @endforeach

        @foreach ($player->team->matchesAsTeamAway as $match)
            <li>{{ $match->teamHome->name }} : {{ $match->teamAway->name }} | Result : {{ $match->match_date }}</li>
        @endforeach

    </div>

</x-layout>
