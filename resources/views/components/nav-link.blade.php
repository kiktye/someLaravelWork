@props(['active' => false])

<a class="{{ $active ? 'bg-gna text-shadowed' : 'text-gna hover:bg-gna hover:text-shadowed' }} rounded-md px-3 py-2 text-sm font-bold block md:inline-block"
    aria-current="{{ $active ? 'page' : 'false' }}" {{ $attributes }}>
    {{ $slot }}</a>
