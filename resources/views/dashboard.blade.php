<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @if(Auth::user()->hasRole(['b2c-customer']))
        @include('web.b2c-dashboard')
    @elseif(Auth::user()->hasRole(['b2b-customer']))
        @include('web.b2b-dashboard')
    @else
        @include('admin.user-list')
    @endif
</x-app-layout>