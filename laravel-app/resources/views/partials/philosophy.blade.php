@php
    /** @var array $t */
    $icons = ['leaf', 'users', 'sparkles', 'heart'];
@endphp

<section id="philosophy" data-testid="philosophy-section" class="py-24 md:py-32 bg-[#FDFBF7]">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="max-w-3xl">
            <div class="reveal">
                <span class="overline-accent" data-testid="section-overline">{{ $t['philosophy']['overline'] }}</span>
            </div>
            <div class="reveal" style="--reveal-delay: 0.1s">
                <h2 class="font-serif text-4xl md:text-5xl text-[#2A2421] tracking-tight mt-4">
                    {{ $t['philosophy']['title'] }}
                </h2>
            </div>
            <div class="reveal" style="--reveal-delay: 0.18s">
                <p class="text-[#6E635A] text-base md:text-lg leading-relaxed mt-5">{{ $t['philosophy']['lead'] }}</p>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-5 mt-14">
            @foreach ($t['philosophy']['cards'] as $i => $c)
                <div class="reveal" style="--reveal-delay: {{ $i * 0.08 }}s">
                    <article
                        data-testid="philosophy-card-{{ $i }}"
                        class="group h-full bg-[#F2EBE1] border border-[#E5D9C5] rounded-2xl p-8 hover:border-[#2C4C3B] transition-colors duration-[400ms]"
                    >
                        <div class="w-12 h-12 rounded-xl bg-[#2C4C3B]/10 flex items-center justify-center mb-6 group-hover:bg-[#2C4C3B] transition-colors">
                            <i data-lucide="{{ $icons[$i] }}" class="w-6 h-6 text-[#2C4C3B] group-hover:text-[#F2EBE1] transition-colors"></i>
                        </div>
                        <span class="overline-accent">{{ $c['tag'] }}</span>
                        <h3 class="font-serif text-2xl md:text-3xl text-[#2A2421] mt-2 mb-3">{{ $c['title'] }}</h3>
                        <p class="text-[#6E635A] leading-relaxed">{{ $c['body'] }}</p>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
</section>
