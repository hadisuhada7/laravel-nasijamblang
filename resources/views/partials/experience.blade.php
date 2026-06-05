@php
    /** @var array $t */
    /** @var array $images */
@endphp

<section id="experience" data-testid="experience-section" class="relative py-28 md:py-40 overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ $images['woodStove'] }}" alt="Etalase" class="w-full h-full object-cover" />
        <div class="absolute inset-0 bg-[#1A140F]/75"></div>
    </div>
    <div class="relative max-w-4xl mx-auto px-6 lg:px-12 text-center text-[#F2EBE1]">
        <div class="reveal">
            <span class="inline-flex items-center gap-2 text-[#E6C58A] uppercase tracking-[0.2em] text-xs font-semibold">
                <span class="w-8 h-px bg-[#D19C4C]"></span> {{ $t['experience']['overline'] }} <span class="w-8 h-px bg-[#D19C4C]"></span>
            </span>
        </div>
        <div class="reveal" style="--reveal-delay: 0.1s">
            <h2 class="font-serif text-4xl md:text-6xl tracking-tight mt-5">{{ $t['experience']['title'] }}</h2>
        </div>
        <div class="mt-10 grid md:grid-cols-2 gap-6 text-left">
            @foreach ($t['experience']['points'] as $i => $p)
                <div class="reveal" style="--reveal-delay: {{ 0.2 + $i * 0.1 }}s">
                    <p data-testid="experience-point-{{ $i }}" class="bg-white/[0.08] backdrop-blur-md border border-white/15 rounded-2xl p-7 text-[#EFE7D9]/90 leading-relaxed">
                        {{ $p }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>
