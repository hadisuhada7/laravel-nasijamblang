@php
    /** @var array $t */
@endphp

<section id="ethics" data-testid="ethics-section" class="py-24 md:py-32 bg-[#2C4C3B] text-[#F2EBE1] relative overflow-hidden">
    <div class="absolute left-1/2 -translate-x-1/2 top-10 opacity-10">
        <i data-lucide="leaf" class="w-40 h-40" style="stroke-width: 0.5;"></i>
    </div>
    <div class="relative max-w-4xl mx-auto px-6 lg:px-12 text-center">
        <div class="reveal">
            <span class="inline-flex items-center gap-2 text-[#E6C58A] uppercase tracking-[0.2em] text-xs font-semibold">
                {{ $t['ethics']['overline'] }}
            </span>
        </div>
        <div class="reveal" style="--reveal-delay: 0.1s">
            <h2 class="font-serif text-4xl md:text-5xl tracking-tight mt-5">{{ $t['ethics']['title'] }}</h2>
        </div>
        <div class="reveal" style="--reveal-delay: 0.18s">
            <blockquote class="font-serif text-2xl md:text-4xl text-[#E6C58A] italic leading-snug mt-10 max-w-3xl mx-auto">
                &ldquo;{{ $t['ethics']['quote'] }}&rdquo;
            </blockquote>
        </div>

        <div class="mt-12 grid md:grid-cols-3 gap-5 text-left">
            @foreach ($t['ethics']['points'] as $i => $p)
                <div class="reveal" style="--reveal-delay: {{ 0.24 + $i * 0.1 }}s">
                    <p data-testid="ethics-point-{{ $i }}" class="bg-[#234032] border border-[#F2EBE1]/[0.12] rounded-2xl p-7 text-[#EFE7D9]/85 text-sm leading-relaxed">
                        <span class="font-serif text-3xl text-[#D19C4C] block mb-2">0{{ $i + 1 }}</span>
                        {{ $p }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>
