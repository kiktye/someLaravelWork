<x-layout>

    <x-page-heading>Welcome, to see the list of matches</x-page-heading>

    @guest
        <x-page-main> You need to <a href="{{ route('login') }}">Log In</a>! </x-page-main>
        <x-page-main> Still not a User? <a href="/register">Sign Up!</a></x-page-main>
    @endguest

    @auth
        <x-page-main> You are logged in! Click to See the list of -> <a href="{{ route('matches.index') }}"
                class="uppercase py-2 px-4 bg-blue-500 rounded-lg text-white">Matches</a></x-page-main>
    @endauth

</x-layout>
