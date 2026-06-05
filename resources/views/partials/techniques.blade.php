@php
    /** @var array $t */
    /** @var array $images */
@endphp

<section id="techniques" data-testid="techniques-section" class="py-24 md:py-32 bg-[#FDFBF7]">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20">
            <div class="lg:sticky lg:top-28 lg:self-start">
                <div class="reveal">
                    <span class="overline-accent" data-testid="section-overline">{{ $t['techniques']['overline'] }}</span>
                </div>
                <div class="reveal" style="--reveal-delay: 0.1s">
                    <h2 class="font-serif text-4xl md:text-5xl text-[#2A2421] tracking-tight mt-4">{{ $t['techniques']['title'] }}</h2>
                </div>
                <div class="reveal" style="--reveal-delay: 0.18s">
                    <p class="text-[#6E635A] text-base md:text-lg leading-relaxed mt-5">{{ $t['techniques']['lead'] }}</p>
                </div>
                <div class="reveal" style="--reveal-delay: 0.26s">
                    <div class="mt-8 rounded-2xl overflow-hidden border border-[#E5D9C5]">
                        <img src="{{ $images['woodStove'] }}" alt="Traditional stove" class="w-full h-72 object-cover" />
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                @foreach ($t['techniques']['tools'] as $i => $tool)
                    <div class="reveal" style="--reveal-delay: {{ $i * 0.08 }}s">
                        <article data-testid="technique-card-{{ $i }}" class="group flex gap-5 bg-[#F2EBE1] border border-[#E5D9C5] rounded-2xl p-5 hover:border-[#2C4C3B] transition-colors">
                            <div class="shrink-0 w-28 h-28 rounded-xl overflow-hidden">
                                <img src="{{ $tool['img'] }}" alt="{{ $tool['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                            </div>
                            <div class="flex flex-col justify-center">
                                <div class="flex items-center gap-2 text-[#8B3A23] mb-1.5">
                                    <i data-lucide="flame" class="w-4 h-4"></i>
                                    <h3 class="font-serif text-2xl text-[#2A2421]">{{ $tool['name'] }}</h3>
                                </div>
                                <p class="text-sm text-[#6E635A] leading-relaxed">{{ $tool['body'] }}</p>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
