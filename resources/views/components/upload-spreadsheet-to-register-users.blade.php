<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>
    <x-section-title>
        <x-slot name="title">{{ __("messages.Bulk User Registration") }}</x-slot>
        <x-slot name="description">
            {{ __("messages.Insert a spreadsheet (XLSX or CSV) to register users in bulk") }}
            <br>
            {{ __("messages.Attention: The spreadsheet should contain the columns: 'Login', 'Email', 'Password'") }}
        </x-slot>
    </x-section-title>
    <div class="mt-5 md:mt-0 md:col-span-2">
        <form method="POST" action="{{ route('store.spreadsheet-users') }}" enctype="multipart/form-data">
            @csrf

            <div class="px-4 py-5 bg-white dark:bg-gray-800 sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                <label for="file" class="block text-white font-bold ml-3 ">{{ __("messages.Upload file") }}</label>
                <div class="">
                    <input type="file" name='file' id="file" wire:model="file"
                        class="shadow appearance-none  w-full py-2 px-3 text-white leading-tight focus:outline-none focus:shadow-outline">
                    @error('file')
                        <span class="text-red-500">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <div
                class="flex items-center justify-end px-4 py-3 bg-gray-50 dark:bg-gray-800 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                <x-button class="ml-3">
                    {{ __('messages.Register users') }}
                </x-button>
            </div>


        </form>
    </div>
</div>
