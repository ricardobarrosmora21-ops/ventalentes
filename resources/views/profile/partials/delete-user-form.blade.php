<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Eliminar Cuenta') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Una vez eliminada tu cuenta, no podrás recuperarla.') }}
        </p>
    </header>

    <form method="POST" action="{{ route('profile.destroy') }}" class="mt-6 space-y-6">
        @csrf
        @method('DELETE')

        <div>
            <x-input-label for="password" :value="__('Contraseña')" />
            <x-text-input id="password" name="password" type="password"
                          class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end">
            <x-danger-button
                x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
                {{ __('Eliminar cuenta') }}
            </x-danger-button>
        </div>
    </form>
</section>
