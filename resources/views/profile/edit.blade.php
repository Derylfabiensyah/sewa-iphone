@php
    $layoutName = auth()->user()->role === 'admin' ? 'admin-layout' : 'customer-layout';
@endphp
<x-dynamic-component :component="$layoutName">
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 tracking-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12 animate-fade-in-up">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-8 bg-white/70 backdrop-blur-xl shadow-sm border border-gray-100 rounded-[2rem] overflow-hidden">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-8 bg-white/70 backdrop-blur-xl shadow-sm border border-gray-100 rounded-[2rem] overflow-hidden">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-8 bg-white/70 backdrop-blur-xl shadow-sm border border-gray-100 rounded-[2rem] overflow-hidden">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-dynamic-component>