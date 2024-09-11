<x-layout>

    <x-page-heading>Edit Player {{ $player->first_name }} </x-page-heading>

    <x-forms.form method="POST" action="{{ route('players.update', $player->id) }}">

        @method('PUT')
        <x-forms.input label="Name" name="first_name" value="{{ old('first_name', $player->first_name) }}" />

        <x-forms.input label="Last Name" name="last_name" value="{{ old('last_name', $player->last_name) }}" />

        <x-forms.input label="Date of Birth" name="birth_date" type="date"
            value="{{ old('birth_date', $player->birth_date) }}" />

        <x-forms.select name="team_id" label="Team">
            @foreach ($teams as $team)
                <option value="{{ $team->id }}"
                    {{ old('team_id', $player->team_id ?? '') == $team->id ? 'selected' : '' }}>
                    {{ $team->name }}</option>
            @endforeach
        </x-forms.select>

        <x-forms.button>Edit Player</x-forms.button>

    </x-forms.form>

</x-layout>
