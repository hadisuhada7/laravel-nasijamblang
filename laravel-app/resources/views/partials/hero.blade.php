@php
    /** @var array $t */
    /** @var array $images */
@endphp

<section id="hero" data-testid="hero-section" class="relative min-h-[100vh] flex items-center overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ $images['hero'] }}" alt="Nasi Jamblang" class="w-full h-full object-cover scale-105" />
        <div class="absolute inset-0 bg-gradient-to-t from-[#1A140F] via-[#1A140F]/55 to-[#1A140F]/40"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-[#1A140F]/70 to-transparent"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-12 w-full pt-24">
        <div class="reveal">
            <span class="inline-flex items-center gap-2 text-[#E6C58A] uppercase tracking-[0.25em] text-xs font-semibold">
                <span class="w-8 h-px bg-[#D19C4C]"></span>
                {{ $t['hero']['overline'] }}
            </span>
        </div>
        <div class="reveal" style="--reveal-delay: 0.12s">
            <h1 class="font-serif text-white text-5xl sm:text-6xl md:text-7xl lg:text-8xl leading-[0.95] tracking-tight mt-6 max-w-4xl">
                {{ $t['hero']['title'] }}
            </h1>
        </div>
        <div class="reveal" style="--reveal-delay: 0.24s">
            <p class="text-white/85 text-base md:text-lg leading-relaxed mt-7 max-w-xl">
                {{ $t['hero']['subtitle'] }}
            </p>
        </div>
        <div class="reveal" style="--reveal-delay: 0.36s">
            <div class="flex flex-wrap items-center gap-4 mt-10">
                <a
                    href="#philosophy"
                    data-testid="hero-cta-primary"
                    class="group inline-flex items-center gap-2 bg-[#D19C4C] text-[#2A2421] font-semibold px-7 py-3.5 rounded-full hover:bg-[#e0ad5f] transition-all"
                >
                    {{ $t['hero']['ctaPrimary'] }}
                    <i data-lucide="chevron-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                </a>
                <a
                    href="#ingredients"
                    data-testid="hero-cta-secondary"
                    class="inline-flex items-center gap-2 border border-white/40 text-white font-medium px-7 py-3.5 rounded-full hover:bg-white/10 transition-all"
                >
                    {{ $t['hero']['ctaSecondary'] }}
                </a>
            </div>
        </div>
    </div>
</section>
