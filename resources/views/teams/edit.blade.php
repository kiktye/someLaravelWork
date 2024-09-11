<x-layout>

    <x-page-heading>Edit Team {{ $team->name }} </x-page-heading>

    <x-forms.form method="POST" action="{{ route('teams.update', $team->id) }}">

        @method('PUT')
        <x-forms.input label="Name" name="name" value="{{ old('name', $team->name ) }}" placeholder="FC Barcelona" />

        <x-forms.input label="Year Founded" name="year_founded" value="{{ old('year_founded', $team->year_founded ) }}" placeholder="1899"/>


        <x-forms.button>Edit Team</x-forms.button>

    </x-forms.form>

</x-layout>
