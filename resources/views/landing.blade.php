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
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    {{-- Lucide icons (replaces lucide-react) --}}
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js" defer></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FDFBF7] min-h-screen">

@if (session('visit_registered'))
    @php $visitFormCopy = config("content.visitor_form.{$lang}"); @endphp
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 5000)"
        x-show="show"
        x-transition.opacity
        data-testid="flash-success"
        class="fixed top-24 right-6 z-[60] max-w-sm bg-[#2C4C3B] text-white shadow-xl rounded-2xl px-5 py-4 flex items-start gap-3"
    >
        <i data-lucide="check-circle-2" class="w-5 h-5 text-[#D19C4C] shrink-0 mt-0.5"></i>
        <p class="text-sm leading-relaxed">{{ $visitFormCopy['successFlash'] }}</p>
        <button type="button" @click="show = false" class="text-white/60 hover:text-white shrink-0">
            <i data-lucide="x" class="w-4 h-4"></i>
        </button>
    </div>
@endif

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
