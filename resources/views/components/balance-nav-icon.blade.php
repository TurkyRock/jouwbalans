@props(['name'])
<svg {{ $attributes->class('balance-nav-icon') }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.65" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        @if($name === 'home')<path d="m3 10 9-7 9 7M5 9v12h5v-7h4v7h5V9"/>
        @elseif($name === 'story')<path d="M12 6c-3-2-6-2-10-1v15c4-1 7-1 10 1m0-15c3-2 6-2 10-1v15c-4-1-7-1-10 1V6M5 9h3m8 0h3M5 13h3m8 0h3"/>
        @elseif($name === 'calendar')<rect x="3" y="5" width="18" height="16" rx="1"/><path d="M7 3v4m10-4v4M3 10h18M7 14h2m6 0h2M7 17h2"/>
        @elseif($name === 'user')<circle cx="12" cy="7" r="4"/><path d="M4 21v-2a8 8 0 0 1 16 0v2"/>
        @elseif($name === 'user-plus')<circle cx="9" cy="7" r="4"/><path d="M2 21v-2a7 7 0 0 1 14 0v2m3-12v8m-4-4h8"/>
        @elseif($name === 'logout')<path d="M10 3H4v18h6m-1-9h13m-5-5 5 5-5 5"/>
        @elseif($name === 'steps')<path d="m5 16 4-4 4 2 6-9m-5 0h5v5M3 21h18"/>
        @elseif($name === 'menu')<path d="M4 6h16M4 12h16M4 18h16"/>
        @elseif($name === 'people')<circle cx="9" cy="7" r="3"/><path d="M2 20v-2a7 7 0 0 1 14 0v2m0-16a3 3 0 0 1 0 6m3 4a6 6 0 0 1 3 5v1"/>
    @endif
</svg>
