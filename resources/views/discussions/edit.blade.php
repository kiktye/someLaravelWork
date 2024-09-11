<x-layout>

    <x-page-heading>Edit Discussion</x-page-heading>

    <x-forms.form method="POST" action="{{ route('discussions.update', $discussion->id) }}" enctype="multipart/form-data">

        @method('PUT')
        <x-forms.input label="Title" name="title" value="{{ old('title', $discussion->title ?? '') }}" />

        <x-forms.input label="Image" name="image" type="file" />

        <x-forms.textarea label="Description" name="description"
            value="{{ old('description', $discussion->description ?? '') }}" />


        <x-forms.select name="category_id" label="Category">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{ old('category_id', $discussion->category_id ?? '') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </x-forms.select>


        <x-forms.button>Update Discussion</x-forms.button>

    </x-forms.form>

</x-layout>
