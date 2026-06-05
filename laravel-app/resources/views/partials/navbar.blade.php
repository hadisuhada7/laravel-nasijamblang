@php
    /** @var string $lang */
    /** @var string $otherLang */
    /** @var array  $t */
    /** @var array  $navKeys */
@endphp

<header
    data-testid="navbar"
    x-data="{ open: false, scrolled: false }"
    x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 24)"
    :class="scrolled ? 'bg-[#FDFBF7]/85 backdrop-blur-xl border-b border-[#E5D9C5]/60' : 'bg-transparent'"
    class="fixed top-0 inset-x-0 z-50 transition-all duration-500"
>
    <div class="max-w-7xl mx-auto px-6 lg:px-12 h-20 flex items-center justify-between">
        {{-- Logo --}}
        <button
            type="button"
            data-testid="nav-logo"
            @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
            class="flex items-center gap-2.5 group"
        >
            <i data-lucide="leaf"
               :class="scrolled ? 'text-[#2C4C3B]' : 'text-[#D19C4C]'"
               class="w-6 h-6 transition-colors"></i>
            <span :class="scrolled ? 'text-[#2A2421]' : 'text-white'"
                  class="font-serif text-xl tracking-tight transition-colors">
                Nasi Jamblang
            </span>
        </button>

        {{-- Desktop nav --}}
        <nav class="hidden lg:flex items-center gap-7">
            @foreach ($navKeys as $key)
                <a
                    href="#{{ $key }}"
                    data-nav-key="{{ $key }}"
                    data-testid="nav-link-{{ $key }}"
                    data-active="false"
                    :class="scrolled ? 'text-[#6E635A]' : 'text-white/85'"
                    class="nav-link relative text-sm tracking-wide transition-colors hover:text-[#D19C4C]"
                >
                    {{ $t['nav'][$key] }}
                    <span class="nav-underline absolute -bottom-1.5 left-0 h-0.5 rounded-full bg-[#D19C4C] transition-all duration-300 w-0"></span>
                </a>
            @endforeach
        </nav>

        {{-- Right cluster --}}
        <div class="flex items-center gap-3">
            {{-- Register Visit (CTA) --}}
            <a
                href="{{ route('visitor.form', ['lang' => $lang]) }}"
                data-testid="cta-register-visit"
                :class="scrolled
                    ? 'bg-[#2C4C3B] text-white hover:bg-[#3a6050]'
                    : 'border border-white/40 text-white hover:bg-white/10'"
                class="hidden lg:inline-flex items-center gap-1.5 text-xs font-semibold px-4 py-2 rounded-full transition-all"
            >
                <i data-lucide="clipboard-list" class="w-3.5 h-3.5"></i>
                {{ $t['register_visit'] }}
            </a>

            {{-- Language toggle --}}
            <div data-testid="language-toggle"
                 :class="scrolled ? 'border-[#E5D9C5]' : 'border-white/30'"
                 class="flex items-center rounded-full border p-0.5">
                @foreach (['id', 'en'] as $l)
                    <a
                        href="{{ route('home', ['lang' => $l]) }}"
                        data-testid="lang-{{ $l }}"
                        class="px-3 py-1 text-xs font-semibold rounded-full transition-all
                            @if($l === $lang) bg-[#2C4C3B] text-white
                            @else
                                {{-- color depends on scroll state --}}
                            @endif"
                        @if($l !== $lang)
                            :class="scrolled ? 'text-[#6E635A]' : 'text-white/80'"
                        @endif
                    >
                        {{ strtoupper($l) }}
                    </a>
                @endforeach
            </div>

            {{-- Mobile menu toggle --}}
            <button
                type="button"
                data-testid="mobile-menu-toggle"
                @click="open = !open"
                :class="scrolled ? 'text-[#2A2421]' : 'text-white'"
                class="lg:hidden"
                aria-label="Toggle menu"
            >
                <i data-lucide="menu" x-show="!open" class="w-6 h-6"></i>
                <i data-lucide="x"    x-show="open"  class="w-6 h-6" x-cloak></i>
            </button>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div
        x-show="open"
        x-cloak
        x-transition.opacity
        data-testid="mobile-menu"
        class="lg:hidden bg-[#FDFBF7] border-t border-[#E5D9C5] px-6 py-4"
    >
        <div class="grid grid-cols-2 gap-x-4 gap-y-1">
            @foreach ($navKeys as $key)
                <a
                    href="#{{ $key }}"
                    data-testid="mobile-nav-link-{{ $key }}"
                    @click="open = false"
                    class="text-left py-2.5 border-b border-[#E5D9C5]/60 text-[#2A2421]"
                >
                    {{ $t['nav'][$key] }}
                </a>
            @endforeach
        </div>
        <div class="mt-4 pt-3 border-t border-[#E5D9C5] flex gap-3">
            <a
                href="{{ route('visitor.form', ['lang' => $lang]) }}"
                data-testid="mobile-cta-register-visit"
                @click="open = false"
                class="flex-1 inline-flex items-center justify-center gap-2 bg-[#2C4C3B] text-white text-sm font-semibold py-2.5 rounded-xl hover:bg-[#3a6050] transition-all"
            >
                <i data-lucide="clipboard-list" class="w-4 h-4"></i>
                {{ $t['register_visit'] }}
            </a>
            <a
                href="{{ route('visitor.index', ['lang' => $lang]) }}"
                data-testid="mobile-cta-visitor-data"
                @click="open = false"
                class="flex-1 inline-flex items-center justify-center gap-2 border border-[#E5D9C5] text-[#2A2421] text-sm font-semibold py-2.5 rounded-xl hover:bg-[#F7F2EA] transition-all"
            >
                <i data-lucide="layout-list" class="w-4 h-4"></i>
                {{ $lang === 'id' ? 'Data Pengunjung' : 'Visitor Data' }}
            </a>
        </div>
    </div>
</header>

<style>
    /* Active nav-link styling (driven by data-active attribute updated by app.js) */
    [data-nav-key][data-active="true"] {
        color: #2C4C3B;
        font-weight: 600;
    }
    [data-nav-key][data-active="true"] .nav-underline {
        width: 100%;
    }
</style>
