<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reseller') }}
        </h2>
        @livewireStyles
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <livewire:reseller-component />
            @livewireScripts
        </div>
    </div>
</x-app-layout>
