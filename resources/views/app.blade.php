<!DOCTYPE html>
<html lang="{{ $page['props']['locale'] ?? str_replace('_', '-', app()->getLocale()) }}"  @class(['dark' => ($appearance ?? 'system') == 'dark'])>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- Inline script to detect system dark mode preference and apply it immediately --}}
        <script>
            (function() {
                const appearance = '{{ $appearance ?? "system" }}';

                if (appearance === 'system') {
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

                    if (prefersDark) {
                        document.documentElement.classList.add('dark');
                    }
                }
            })();
        </script>

        {{-- Inline style to set the HTML background color based on our theme in app.css --}}
        <style>
            html {
                background-color: oklch(1 0 0);
            }

            html.dark {
                background-color: oklch(0.145 0 0);
            }
        </style>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        @fonts

        @vite(['resources/css/app.css', 'resources/js/app.ts', "resources/js/pages/{$page['component']}.vue"])
        <x-inertia::head>
            @if (isset($page['props']['seo']))
                <title data-inertia>{{ $page['props']['seo']['title'] }}</title>
                <meta data-inertia="description" name="description" content="{{ $page['props']['seo']['description'] }}">
                @if ($page['component'] === 'Welcome')
                    <meta data-inertia="og:type" property="og:type" content="website">
                    <meta data-inertia="og:title" property="og:title" content="{{ $page['props']['seo']['title'] }}">
                    <meta data-inertia="og:description" property="og:description" content="{{ $page['props']['seo']['description'] }}">
                    <meta data-inertia="og:locale" property="og:locale" content="{{ ($page['props']['locale'] ?? 'es') === 'en' ? 'en_US' : 'es_CO' }}">
                @elseif ($page['component'] === 'PrivacyPolicy')
                    <link data-inertia="canonical" rel="canonical" href="{{ ($page['props']['locale'] ?? 'es') === 'en' ? route('privacy.en') : route('privacy') }}">
                    <link data-inertia="alternate-es" rel="alternate" hreflang="es-CO" href="{{ route('privacy') }}">
                    <link data-inertia="alternate-en" rel="alternate" hreflang="en-US" href="{{ route('privacy.en') }}">
                    <link data-inertia="alternate-default" rel="alternate" hreflang="x-default" href="{{ route('privacy') }}">
                @elseif ($page['component'] === 'TermsAndConditions')
                    <link data-inertia="canonical" rel="canonical" href="{{ ($page['props']['locale'] ?? 'es') === 'en' ? route('terms.en') : route('terms') }}">
                    <link data-inertia="alternate-es" rel="alternate" hreflang="es-CO" href="{{ route('terms') }}">
                    <link data-inertia="alternate-en" rel="alternate" hreflang="en-US" href="{{ route('terms.en') }}">
                    <link data-inertia="alternate-default" rel="alternate" hreflang="x-default" href="{{ route('terms') }}">
                @endif
            @else
                <title data-inertia>{{ config('app.name', 'Laravel') }}</title>
            @endif
        </x-inertia::head>
    </head>
    <body class="font-sans antialiased">
        <x-inertia::app />
    </body>
</html>
