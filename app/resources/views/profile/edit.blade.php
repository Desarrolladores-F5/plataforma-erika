<x-app-layout :hideNav="true">
    <x-slot name="header">
        <div>
            <h2 class="brand-title">
                Mi Perfil
            </h2>
            <p class="brand-subtitle mt-1">
                Administra tu información y seguridad de tu cuenta.
            </p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- ✅ Feedback PRO --}}
            @if (session('status') === 'profile-updated')
                <x-alert type="success">
                    ✅ Tu información fue actualizada correctamente.
                </x-alert>
            @endif

            @if ($errors->any())
                <x-alert type="error">
                    ❌ Revisa los campos marcados e inténtalo nuevamente.
                </x-alert>
            @endif

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
