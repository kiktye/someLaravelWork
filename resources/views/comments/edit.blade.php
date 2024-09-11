<x-layout>

    <x-forms.form method="POST" action="{{ route('comments.update', $comment) }}">

        @method('PUT')
        <x-forms.textarea label="Comment" name="content" value="{{ old('content', $comment->content ?? '') }}"/>

        <x-forms.button>Edit comment</x-forms.button>

    </x-forms.form>

</x-layout>
