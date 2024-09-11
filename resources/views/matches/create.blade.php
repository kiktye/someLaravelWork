<x-layout>

    <x-page-heading>Create New Match</x-page-heading>

    <x-forms.form method="POST" action="{{ route('matches.store') }}">

        <x-forms.select name="team_home_id" label="Team Home">
            @foreach ($teams as $team)
                <option value="{{ $team->id }}">{{ $team->name }}</option>
            @endforeach
        </x-forms.select>

        <x-forms.select name="team_away_id" label="Team Away">
            @foreach ($teams as $team)
                <option value="{{ $team->id }}">{{ $team->name }}</option>
            @endforeach
        </x-forms.select>

        <x-forms.checkbox label="Match Is Finished" name="is_played" value="1"/>

        <x-forms.input label="Date" name="match_date" type="datetime-local" value="{{ old('match_date') }}" />

        <x-forms.divider />

        <x-forms.input label="Team Home Score" name="team_home_score" value="{{ old('team_home_score') }}" />

        <x-forms.input label="Team Away Score" name="team_away_score" value="{{ old('team_away_score') }}" />


        <x-forms.button>Add Match</x-forms.button>

    </x-forms.form>

</x-layout>