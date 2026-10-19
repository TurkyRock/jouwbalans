<x-layouts.balance :title="$title ?? 'Mijn account'" :app-ui="true">
    <div class="craft-settings-wrap">
        <section class="craft-settings-sheet">
        {{ $slot }}
        </section>
    </div>
</x-layouts.balance>
