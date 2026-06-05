@php
    /** @var array $t */
@endphp

<section id="ingredients" data-testid="ingredients-section" class="py-24 md:py-32 bg-[#F2EBE1]">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="max-w-3xl">
            <div class="reveal">
                <span class="overline-accent" data-testid="section-overline">{{ $t['ingredients']['overline'] }}</span>
            </div>
            <div class="reveal" style="--reveal-delay: 0.1s">
                <h2 class="font-serif text-4xl md:text-5xl text-[#2A2421] tracking-tight mt-4">{{ $t['ingredients']['title'] }}</h2>
            </div>
            <div class="reveal" style="--reveal-delay: 0.18s">
                <p class="text-[#6E635A] text-base md:text-lg leading-relaxed mt-5">{{ $t['ingredients']['lead'] }}</p>
            </div>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-14">
            @foreach ($t['ingredients']['items'] as $i => $it)
                <div class="reveal" style="--reveal-delay: {{ $i * 0.08 }}s">
                    <article data-testid="ingredient-card-{{ $i }}" class="group bg-[#FDFBF7] border border-[#E5D9C5] rounded-2xl overflow-hidden h-full hover:border-[#8B3A23] transition-colors duration-[400ms]">
                        <div class="aspect-[4/5] overflow-hidden">
                            <img src="{{ $it['img'] }}" alt="{{ $it['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                        </div>
                        <div class="p-6">
                            <span class="overline-accent">{{ $it['role'] }}</span>
                            <h3 class="font-serif text-2xl text-[#2A2421] mt-1.5 mb-2.5">{{ $it['name'] }}</h3>
                            <p class="text-sm text-[#6E635A] leading-relaxed">{{ $it['body'] }}</p>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>

        <div class="reveal" style="--reveal-delay: 0.1s">
            <div data-testid="ingredient-variety" class="mt-14 bg-[#2C4C3B] rounded-3xl p-10 md:p-14 text-[#F2EBE1]">
                <div class="flex items-center gap-2 text-[#E6C58A] uppercase tracking-[0.2em] text-xs font-semibold">
                    <i data-lucide="soup" class="w-4 h-4"></i> {{ $t['ingredients']['varietyTitle'] }}
                </div>
                <p class="text-[#EFE7D9] leading-relaxed mt-4 max-w-3xl text-base md:text-lg">{{ $t['ingredients']['varietyBody'] }}</p>
                <div class="flex flex-wrap gap-3 mt-8">
                    @foreach ($t['ingredients']['varietyList'] as $v)
                        <span class="px-4 py-2 rounded-full border border-[#F2EBE1]/25 text-sm text-[#F2EBE1] hover:bg-[#F2EBE1]/10 transition-colors">
                            {{ $v }}
                        </span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
