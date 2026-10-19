@auth
    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}" @if(request()->routeIs('dashboard')) aria-current="page" @endif><x-balance-nav-icon name="home" /><span>Mijn balans</span></a>
    <a class="nav-link {{ request()->routeIs('balance.calendar') ? 'active' : '' }}" href="{{ route('balance.calendar') }}" @if(request()->routeIs('balance.calendar')) aria-current="page" @endif><x-balance-nav-icon name="calendar" /><span>Mijn kalender</span></a>
    <a class="nav-link {{ request()->routeIs('*.edit') ? 'active' : '' }}" href="{{ route('profile.edit') }}"><x-balance-nav-icon name="user" /><span>Mijn account</span></a>
    <form method="POST" action="{{ route('logout') }}">@csrf<button class="nav-link nav-logout" type="submit"><x-balance-nav-icon name="logout" /><span>Uitloggen</span></button></form>
@else
    <a class="nav-link" href="{{ route('home') }}#waarom"><x-balance-nav-icon name="story" /><span>Mijn verhaal</span></a>
    <a class="nav-link" href="{{ route('home') }}#programma"><x-balance-nav-icon name="steps" /><span>Zo werkt het</span></a>
    <a class="nav-link" href="{{ route('home') }}#samen"><x-balance-nav-icon name="people" /><span>Samen</span></a>
    <a class="nav-link" href="{{ route('register') }}"><x-balance-nav-icon name="user-plus" /><span>Registreren</span></a>
    <a class="nav-link" href="{{ route('login') }}"><x-balance-nav-icon name="user" /><span>Inloggen</span></a>
@endauth
