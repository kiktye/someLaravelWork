<x-layout>

    <x-page-heading>Create Discussion</x-page-heading>

    <x-forms.form method="POST" action="{{ route('discussions.store') }}" enctype="multipart/form-data">

        <x-forms.input label="Title" name="title" value="{{ old('title') }}" />

        <x-forms.input label="Image" name="image" type="file" />

        <x-forms.textarea label="Description" name="description" value="{{ old('description') }}" />


        <x-forms.select name="category_id" label="Category">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </x-forms.select>


        <x-forms.button>Create Discussion</x-forms.button>

    </x-forms.form>

</x-layout>
