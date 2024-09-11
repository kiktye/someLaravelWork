<x-layout>

    <x-page-heading>Edit Match</x-page-heading>

    <x-forms.form method="POST" action="{{ route('matches.update', $match->id) }}">

        {{-- {{ dd($match) }} --}}

        @method('PUT')
        <x-forms.select name="team_home_id" label="Team Home">
            @foreach ($teams as $team)
                <option value="{{ $team->id }}"
                    {{ old('team_home_id', $match->teamHome ?? '') == $team->id ? 'selected' : '' }}>{{ $team->name }}
                </option>
            @endforeach
        </x-forms.select>

        <x-forms.select name="team_away_id" label="Team Away">
            @foreach ($teams as $team)
                <option value="{{ $team->id }}"
                    {{ old('team_away_id', $match->teamAway ?? '') == $team->id ? 'selected' : '' }}>
                    {{ $match->teamAway->name }}</option>
            @endforeach
        </x-forms.select>

        <x-forms.checkbox label="Match Is Finished" name="is_played" value="1" :checked="$match->is_played" />

        <x-forms.input label="Date" name="match_date" type="datetime-local"
            value="{{ old('match_date', $match->match_date) }}" />

        <x-forms.divider />

        <x-forms.input label="Team Home Score" name="team_home_score"
            value="{{ old('team_home_score', $match->team_home_score) }}" />

        <x-forms.input label="Team Away Score" name="team_away_score"
            value="{{ old('team_away_score', $match->team_away_score) }}" />


        <x-forms.button>Edit Match</x-forms.button>

    </x-forms.form>

</x-layout>
