<div class="dashboard-scrapbook">
    <section class="hero dashboard-hero" aria-labelledby="balance-greeting">
        <div class="hero-copy"><span class="eyebrow">{{ $today->locale('nl')->translatedFormat('l j F') }} · fijn dat je er bent, {{ auth()->user()->name }}</span><div class="hero-title-paper"><h1 id="balance-greeting">Hoe is het met je<br>vandaag?</h1></div><p>Even voelen. Je hoeft niets te bewijzen.<br>Wat verdient vandaag een beetje ruimte?</p><a class="button mustard-button" href="{{ route('balance.calendar') }}">Bekijk mijn kalender <span aria-hidden="true">→</span></a></div>
        <div class="dashboard-photo-collage"><div class="collage-paper collage-paper-sage"></div><img src="{{ asset('images/balance/rest-v2.webp') }}" alt="Een rustig moment met een kop thee" width="1536" height="1024"><span class="dashboard-photo-note">Ook dit is<br>een goede dag.</span><x-balance-leaf class="dashboard-leaf" /></div>
    </section>
    @include('livewire.balance-start')
    <div class="dashboard-grid">
        <section class="paper today-card"><div class="section-heading"><div><span class="eyebrow">Rustig aan, stap voor stap</span><h2>Ruimte voor vandaag</h2></div><span class="date-badge">{{ $today->format('d') }}<small>{{ $today->locale('nl')->translatedFormat('M') }}</small></span></div>
            @forelse ($days->get($today->toDateString()) as $event)
                <a class="agenda-row" href="{{ route('balance.calendar') }}"><span class="time">{{ substr($event->starts_at, 0, 5) }}</span><span class="category-dot cat-{{ $event->category }}"></span><span><strong>{{ $event->title }}</strong><small>{{ \App\Models\BalanceEvent::CATEGORIES[$event->category] }}</small>@if($event->small_version)<small class="gentle">Klein mag ook: {{ $event->small_version }}</small>@endif</span><span class="row-arrow">↗</span></a>
            @empty
                <div class="empty-state"><span>☀</span><h3>Een beetje ruimte.</h3><p>Je hebt vandaag nog niets gepland. Misschien een wandeling, even lezen of samen eten?</p><a class="text-link" href="{{ route('balance.calendar') }}">Plan je eerste moment →</a></div>
            @endforelse
            <p class="footnote">Je planning is een hulpmiddel. Je mag ervan afwijken.</p>
        </section>
        <aside class="paper yellow affirmation"><span class="eyebrow">Een vriendelijke gedachte</span><span class="quote-mark">“</span><h2>Ik mag goed voor mezelf zorgen, ook als het even niet lukt.</h2><p>Neem deze gedachte mee. Je hoeft er vandaag niets voor te bewijzen.</p><span class="handwritten">Je bent het waard.</span></aside>
    </div>
    <section class="paper week-preview"><div class="section-heading"><div><span class="eyebrow">Vooruitkijken zonder haast</span><h2>De komende dagen</h2></div><a class="text-link" href="{{ route('balance.calendar') }}">Hele kalender →</a></div><div class="week-strip">
        @foreach($days as $date => $events)
            @php($day = \Carbon\CarbonImmutable::parse($date)->locale('nl'))
            <div class="week-preview-day {{ $date === $today->toDateString() ? 'is-today' : '' }} {{ $date === $startDate ? 'is-balance-start' : '' }}"><small>{{ $day->translatedFormat('D') }}</small><strong>{{ $day->format('j') }}</strong>@if($date === $startDate)<span class="balance-start-marker">★ Mijn eerste stap</span>@endif
                @forelse($events->take(3) as $event)<span class="event-pill cat-{{ $event->category }}">{{ $event->title }}</span>@empty<span class="quiet">Ruimte</span>@endforelse @if($events->count() > 3)<small>+ {{ $events->count() - 3 }} momenten</small>@endif</div>
        @endforeach
    </div></section>
    <div class="closing-paper dashboard-closing"><x-balance-leaf /><p>Niet alles tegelijk, wel iets vandaag.</p><span>Zorg goed voor jezelf,<br>dat is genoeg.</span></div>
    <section class="three-columns gentle-cards"><article><span class="eyebrow">Voeden</span><h3>Iets fijns op je bord.</h3><p>Een kleine voorbereiding kan je later wat rust geven.</p></article><article><span class="eyebrow">Bewegen</span><h3>Ook vijf minuten tellen.</h3><p>Kies iets waar jij plezier of energie uit haalt.</p></article><article><span class="eyebrow">Ontspannen</span><h3>Even niets hoeven.</h3><p>Rust hoeft geen beloning te zijn. Je mag het inplannen.</p></article></section>
</div>
