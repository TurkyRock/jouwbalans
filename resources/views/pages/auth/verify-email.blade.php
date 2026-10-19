<x-layouts::auth :title="__('Bevestig je e-mailadres')">
    <div class="mt-4 flex flex-col gap-6">
        <flux:text class="text-center">
            {{ __('Bijna klaar! Klik op de link in je e-mail om je account te bevestigen.') }}
        </flux:text>

        @if (session('status') == 'verification-link-sent')
            <flux:text class="text-center font-medium !dark:text-green-400 !text-green-600">
                {{ __('Er staat een nieuwe bevestigingslink voor je klaar in je e-mail.') }}
            </flux:text>
        @endif

        <div class="flex flex-col items-center justify-between space-y-3">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <flux:button type="submit" variant="primary" class="w-full">
                    {{ __('Stuur de link opnieuw') }}
                </flux:button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <flux:button variant="ghost" type="submit" class="text-sm cursor-pointer" data-test="logout-button">
                    {{ __('Uitloggen') }}
                </flux:button>
            </form>
        </div>
    </div>
</x-layouts::auth>
