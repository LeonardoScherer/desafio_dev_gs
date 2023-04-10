{{-- @dd($merge_pokemons) --}}
@foreach ($merge_pokemons as $pokemon)
    <div>{{ $pokemon['name'] }}</div>
    <div>{{ $pokemon['base_experience'] }}</div>
    <div>{{ $pokemon['location_area_encounters'] }}</div>
@endforeach

@if (!@empty($next_url))
<a href="{{route('pokemons', ['next_url' => $next_url])}}">Next</a>
    @dd($next_url)
@endif
{{-- {{ $pokemons->links() }} --}}
