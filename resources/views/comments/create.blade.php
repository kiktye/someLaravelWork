<x-layout>

    <x-forms.form method="POST" action="{{ route('comments.store', $discussion) }}">

        <x-forms.textarea label="Comment" name="content" />

        <x-forms.button>Add Comment</x-forms.button>

    </x-forms.form>

</x-layout>
