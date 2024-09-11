<x-layout>

    <x-page-heading>Add New Player</x-page-heading>

    <x-forms.form method="POST" action="{{ route('players.store') }}">

        <x-forms.input label="Name" name="first_name" value="{{ old('first_name') }}" />

        <x-forms.input label="Last Name" name="last_name" value="{{ old('last_name') }}" />

        <x-forms.input label="Date of Birth" name="birth_date" type="date" value="{{ old('birth_name') }}" />

        <x-forms.select name="team_id" label="Team">
            @foreach ($teams as $team)
                <option value="{{ $team->id }}">{{ $team->name }}</option>
            @endforeach
        </x-forms.select>

        <x-forms.button>Add Player</x-forms.button>

    </x-forms.form>

</x-layout>