<x-layout>

    <x-page-heading>Create New Team</x-page-heading>

    <x-forms.form method="POST" action="{{ route('teams.store') }}">

        <x-forms.input label="Name" name="name" value="{{ old('name') }}" placeholder="FC Barcelona" />

        <x-forms.input label="Year Founded" name="year_founded" type="text" placeholder="1899"/>


        <x-forms.button>Add Team</x-forms.button>

    </x-forms.form>

</x-layout>
