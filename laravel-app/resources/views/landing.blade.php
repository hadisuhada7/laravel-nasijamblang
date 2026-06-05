@php
    /** @var string $lang */
    /** @var array  $t */
    /** @var array  $images */

    $navKeys = ['philosophy', 'ingredients', 'techniques', 'tasting', 'serving', 'experience', 'nutrition', 'ethics'];
    $otherLang = $lang === 'id' ? 'en' : 'id';
@endphp
<!doctype html>
<html lang="{{ $lang }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#1A140F" />
    <meta name="description" content="Gastronomi Nasi Jamblang - Warisan Kuliner Pesisir Cirebon" />
    <title>{{ $t['footer']['brand'] }} - {{ $t['footer']['tagline'] }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    {{-- Lucide icons (replaces lucide-react) --}}
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js" defer></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FDFBF7] min-h-screen">

@include('partials.navbar', ['lang' => $lang, 't' => $t, 'otherLang' => $otherLang, 'navKeys' => $navKeys])

<main>
    @include('partials.hero',        ['t' => $t, 'images' => $images])
    @include('partials.philosophy',  ['t' => $t])
    @include('partials.ingredients', ['t' => $t])
    @include('partials.techniques',  ['t' => $t, 'images' => $images])
    @include('partials.tasting',     ['t' => $t, 'images' => $images])
    @include('partials.serving',     ['t' => $t, 'images' => $images])
    @include('partials.experience',  ['t' => $t, 'images' => $images])
    @include('partials.nutrition',   ['t' => $t])
    @include('partials.ethics',      ['t' => $t])
</main>

@include('partials.footer', ['t' => $t])

{{-- Scroll-to-top button --}}
<button
    type="button"
    data-testid="scroll-to-top"
    aria-label="Scroll to top"
    x-data="{ show: false }"
    x-init="window.addEventListener('scroll', () => show = window.scrollY > 400)"
    @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
    :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4 pointer-events-none'"
    class="fixed bottom-6 right-6 z-50 w-11 h-11 rounded-full bg-[#B8860B] text-white flex items-center justify-center shadow-lg transition-all duration-300 hover:bg-[#9a7009]"
>
    <i data-lucide="arrow-up" class="w-5 h-5"></i>
</button>

</body>
</html>
