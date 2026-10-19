<section class="balance-start-card paper-piece" aria-labelledby="balance-start-title-{{ $this->getId() }}">
    <div class="balance-start-intro">
        <span class="eyebrow">Een kleine stap is ook beginnen</span>
        <h2 id="balance-start-title-{{ $this->getId() }}">Van plannen naar proberen.</h2>
        <p>Plannen helpt. Door te beginnen ontdek je wat bij je past. Welke dag zet jij je eerste kleine stap?</p>
        @if($savedStartDate)
            <p class="balance-start-summary"><span aria-hidden="true">★</span> Mijn eerste stap: <strong>{{ $savedStartDate->locale('nl')->translatedFormat('j F Y') }}</strong></p>
            <a class="text-link" href="{{ route('balance.calendar', ['start' => $savedStartDate->toDateString()]) }}">Bekijk mijn startdag →</a>
        @endif
    </div>
    <form wire:submit="saveBalanceStart" class="balance-start-form">
        <label for="balance-start-date-{{ $this->getId() }}">Mijn startdatum</label>
        <input id="balance-start-date-{{ $this->getId() }}" type="date" wire:model="balanceStartDate" min="1901-01-01" max="2099-12-31" aria-describedby="balance-start-help-{{ $this->getId() }}">
        @error('balanceStartDate')<span class="field-error">Kies een geldige datum tussen 1901 en 2099.</span>@enderror
        <div class="balance-start-actions"><button type="submit" class="button mustard-button" wire:loading.attr="disabled">Markeer mijn start <span aria-hidden="true">→</span></button>@if($savedStartDate)<button type="button" class="text-button" wire:click="clearBalanceStart">Datum wissen</button>@endif</div>
        <small id="balance-start-help-{{ $this->getId() }}">Je kiest zelf. Vandaag mag ook. Je kunt je datum aanpassen.</small>
        @if($startDateSaved)<p role="status" class="balance-start-feedback">{{ $savedStartDate ? 'Je startdatum is bewaard en gemarkeerd in je kalender.' : 'Je startdatum is gewist.' }}</p>@endif
    </form>
</section>
