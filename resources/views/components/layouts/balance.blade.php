@props(['title' => 'Welkom', 'appUi' => false])
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light">
    <meta name="theme-color" content="#f2ebda">
    <title>{{ $title ?? 'Welkom' }} · Jouw Balans</title>
    @if($appUi)
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @fluxAppearance
    @endif
    <link rel="stylesheet" href="{{ asset('css/balance-fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/balance.css') }}?v={{ filemtime(public_path('css/balance.css')) }}">
    <link rel="stylesheet" href="{{ asset('css/balance-paper-v2.css') }}?v={{ filemtime(public_path('css/balance-paper-v2.css')) }}">
    @if(request()->routeIs('home'))
        <link rel="stylesheet" href="{{ asset('css/balance-scrapbook-v3.css') }}?v={{ filemtime(public_path('css/balance-scrapbook-v3.css')) }}">
        <link rel="stylesheet" href="{{ asset('css/balance-scrapbook-v4.css') }}?v={{ filemtime(public_path('css/balance-scrapbook-v4.css')) }}">
        <link rel="stylesheet" href="{{ asset('css/balance-home-v5.css') }}?v={{ filemtime(public_path('css/balance-home-v5.css')) }}">
    @endif
    <link rel="stylesheet" href="{{ asset('css/balance-paper-v6.css') }}?v={{ filemtime(public_path('css/balance-paper-v6.css')) }}">
    <link rel="stylesheet" href="{{ asset('css/balance-cut-v7.css') }}?v={{ filemtime(public_path('css/balance-cut-v7.css')) }}">
    <link rel="stylesheet" href="{{ asset('css/balance-material-v8.css') }}?v={{ filemtime(public_path('css/balance-material-v8.css')) }}">
    <link rel="stylesheet" href="{{ asset('css/balance-edge-v9.css') }}?v={{ filemtime(public_path('css/balance-edge-v9.css')) }}">
    <link rel="stylesheet" href="{{ asset('css/balance-edge-v10.css') }}?v={{ filemtime(public_path('css/balance-edge-v10.css')) }}">
    <link rel="stylesheet" href="{{ asset('css/balance-founder-v12.css') }}?v={{ filemtime(public_path('css/balance-founder-v12.css')) }}">
    <link rel="stylesheet" href="{{ asset('css/balance-layered-edge-v14.css') }}?v={{ filemtime(public_path('css/balance-layered-edge-v14.css')) }}">
    <link rel="stylesheet" href="{{ asset('css/balance-frame-v15.css') }}?v={{ filemtime(public_path('css/balance-frame-v15.css')) }}">
    <link rel="stylesheet" href="{{ asset('css/balance-corners-v17.css') }}?v={{ filemtime(public_path('css/balance-corners-v17.css')) }}">
    <link rel="stylesheet" href="{{ asset('css/balance-rounded-frame-v18.css') }}?v={{ filemtime(public_path('css/balance-rounded-frame-v18.css')) }}">
    <link rel="stylesheet" href="{{ asset('css/balance-compact-hero-v19.css') }}?v={{ filemtime(public_path('css/balance-compact-hero-v19.css')) }}">
    <link rel="stylesheet" href="{{ asset('css/balance-community-v21.css') }}?v={{ filemtime(public_path('css/balance-community-v21.css')) }}">
    <link rel="stylesheet" href="{{ asset('css/balance-consistency-v21.css') }}?v={{ filemtime(public_path('css/balance-consistency-v21.css')) }}">
    <link rel="stylesheet" href="{{ asset('css/balance-collage-v23.css') }}?v={{ filemtime(public_path('css/balance-collage-v23.css')) }}">
    <link rel="stylesheet" href="{{ asset('css/balance-portraits-v24.css') }}?v={{ filemtime(public_path('css/balance-portraits-v24.css')) }}">
    @livewireStyles
</head>
<body class="balance-paper-site craft-site {{ request()->routeIs('home') ? 'scrapbook-site' : '' }} {{ $appUi ? 'craft-account-ui' : '' }}">
    <a href="#main-content" class="skip-to-content">Naar de inhoud</a>
    <div class="site-paper-shell">
        <div class="rounded-paper-frame" aria-hidden="true"></div>
        @if(request()->routeIs('home'))
            <div class="page-collage-backdrop" aria-hidden="true"></div>
        @endif
        <header class="site-header">
            <a class="brand" href="{{ route('home') }}"><x-balance-leaf class="brand-leaf" /><span>Jouw Balans</span></a>
            <nav class="desktop-navigation" aria-label="Hoofdnavigatie">@include('partials.balance-navigation')</nav>
            <details class="mobile-navigation">
                <summary>Menu <x-balance-nav-icon name="menu" /></summary>
                <nav aria-label="Mobiele hoofdnavigatie">@include('partials.balance-navigation')</nav>
            </details>
        </header>
        <main id="main-content" class="main-wrap" tabindex="-1">{{ $slot }}</main>
        <footer class="site-footer"><a href="{{ route('home') }}" class="brand-mini"><x-balance-leaf /> Jouw Balans</a><span>Kleine stappen. Meer in balans.</span><span>Eten · bewegen · ontspannen</span></footer>
    </div>
    @if($appUi)
        @persist('toast')
            <flux:toast.group><flux:toast /></flux:toast.group>
        @endpersist
        @fluxScripts
    @else
        @livewireScripts
    @endif
</body>
</html>
