<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-5 md:gap-6']) }}>
    <div class="mt-5 md:mt-0 md:col-span-6">

        <div style="background-color: rgb(30 41 59);" class="px-4 py-5 bg-sky-500 sm:p-6 shadow sm:rounded-md">

            <img src="{{ $pokemon['pokemon_gif'] }}" alt="{{ $pokemon['name'] }}" style="width:48px;height:48px; float: right; margin-left: auto;" onclick='Livewire.emit("openModal", "pokemon-view", @json(["pokemon" => $pokemon]))'>

            <h1 class="block text-white font-bold ml-3"><span class="text-slate-600">{{__('messages.Name')}}:</span> {{ $pokemon['name']}} </h1>
            <h3 class="text-white ml-3 font-bold"><span class="text-slate-600">{{__('messages.Location area')}}:</span> {{ $pokemon['location_area_encounters'] }}</h3>
            <span class="text-white ml-3"><span class="text-slate-600">{{__('messages.Base experience')}}:</span> {{ $pokemon['base_experience'] }} </span>
        </div>

    </div>
</div>
