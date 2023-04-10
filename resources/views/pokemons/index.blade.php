<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('List Pokemons') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden shadow-xl sm:rounded-lg">
                <div style="background-color: rgb(3 7 18);"
                    class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-8 p-6 lg:p-8">
                    {{-- @dd($merge_pokemons) --}}
                    @foreach ($list_pokemons as $specific_pokemon)
                        <x-pokemon-list :pokemon="$specific_pokemon" />
                    @endforeach
                    <span>
                        @if ($previous_url)
                            <a class="dark:text-gray-200" href="{{ route('pokemons', [$previous_url]) }}">
                                << {{ __('messages.Previous') }}</a>
                        @endif
                        @if ($previous_url && $next_url)
                            <span class="dark:text-gray-200">|</span>
                        @endif
                        @if ($next_url)
                            <a class="dark:text-gray-200"
                                href="{{ route('pokemons', [$next_url]) }}">{{ __('messages.Next') }} >></a>
                        @endif
                    </span>
                    <a class="dark:text-gray-200" href="{{ route('downloadListPokemons', ['encode' => json_encode($list_pokemons)] ) }}">Download List</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
