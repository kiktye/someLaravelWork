<x-layout>
    <x-page-heading>Register</x-page-heading>

    <x-forms.form method="POST" action="/register">

        <x-forms.input label="Name" name="name" />

        <x-forms.input label="Email" type="email" name="email" />

        <x-forms.input label="Password" type="password" name="password" />

        <x-forms.divider />

        <x-forms.button>Create Account</x-forms.button>
    </x-forms.form>
</x-layout>
