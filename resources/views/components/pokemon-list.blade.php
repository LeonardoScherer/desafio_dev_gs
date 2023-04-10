<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-5 md:gap-6 h-40']) }}>
    <div class="mt-5 md:mt-0 md:col-span-6 h-40">

        <div style="background-color: rgb(30 41 59);" class="px-4 py-5 bg-sky-500 sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
            <img src=" {{ $pokemon['pokemon_gif'] }}" alt="{{ $pokemon['name'] }}" style="width:48px;height:48px; float: right; margin-left: auto;">

            <h1 class="block text-white font-bold ml-3">{{__('messages.Name')}}: {{ $pokemon['name']}} </h1>
            <h3 class="text-white grid grid-cols-12 gap-6 ml-3 font-bold">{{__('messages.Location area')}}: {{ $pokemon['location_area_encounters'] }}</h3>
            <span class="text-white grid grid-cols-12 gap-6 ml-3">{{__('messages.Base experience')}}: {{ $pokemon['base_experience'] }} </span>
        </div>

    </div>
</div>
