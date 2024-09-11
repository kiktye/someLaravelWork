@props(['discussion', 'width' => 90])

<img src="{{ asset('storage/' . $discussion->image) }}" alt="IMG" class="rounded-xl" width="{{ $width }}">