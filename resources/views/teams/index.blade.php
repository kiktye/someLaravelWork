<x-layout>

    <div class="flex flex-col">

        @if (session('success'))
            <div class="p-4 text-sm text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300">
                <span class="font-medium"> {{ session('success') }} </span>
            </div>
        @endif

        <div class="self-end my-5">
            <a href="{{ route('teams.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-gna font-bold py-2 px-4 rounded">Add new Team</a>
        </div>

        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden">



                    <table class="min-w-full divide-y divide-gray-200">

                        <thead>
                            <tr class="border border-gray-300">
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Name</th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Year
                                    Founded
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Info
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($teams as $team)
                                <tr class="odd:bg-white even:bg-gray-100 hover:bg-gray-100">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">

                                        {{ $team->name }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                        {{ $team->year_founded }} </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-500">
                                        <a href="{{ route('teams.show', $team->id) }}"> View </a>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">

                                        {{-- Edit --}}
                                        <a href=" {{ route('teams.edit', $team->id) }} "><i
                                                class="fa-regular fa-pen-to-square"></i></a>


                                        {{-- Delete --}}
                                        <x-forms.form action="{{ route('teams.destroy', $team->id) }}" method="POST"
                                            style="display:inline;" class="space-y-0"
                                            onsubmit="return confirm('Are you sure you want to delete this team?');">
                                            @method('DELETE')
                                            <button type="submit" style="border:none; background:none;">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </x-forms.form>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-layout>
