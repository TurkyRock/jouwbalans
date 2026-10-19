<x-layouts.balance :title="$title ?? 'Welkom'" :app-ui="true">
    <div class="craft-auth-wrap {{ request()->routeIs('register') ? 'craft-register-wrap' : '' }}">
        @if(request()->routeIs('register'))
            <aside class="craft-register-story">
                <span class="craft-free-note">Gratis meedoen.</span>
                <h2>Een beetje meer<br>ruimte voor jou.</h2>
                <p>Meer rust, fijn bewegen of aandacht voor elkaar. Jij ontdekt wat bij jouw leven past, in kleine stappen.</p>
                <div class="craft-register-photo"><img src="{{ asset('images/balance/rest-v2.webp') }}" width="1536" height="1024" alt="Een rustig moment met een kop thee"><span>Jouw leven. Jouw ritme.</span></div>
                <p class="craft-register-small">Geen magische formule. Wel handvatten.<br>En ruimte om het op jouw manier te doen.</p>
            </aside>
        @endif
        <section class="craft-form-sheet">
            <span class="craft-form-tape" aria-hidden="true"></span>
            {{ $slot }}
        </section>
        <p class="craft-form-note">Een beetje ruimte voor jezelf.</p>
    </div>
</x-layouts.balance>
