@php
    /** @var array $t */
    /** @var array $images */
@endphp

<section id="serving" data-testid="serving-section" class="py-24 md:py-32 bg-[#FDFBF7]">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="max-w-3xl">
            <div class="reveal">
                <span class="overline-accent" data-testid="section-overline">{{ $t['serving']['overline'] }}</span>
            </div>
            <div class="reveal" style="--reveal-delay: 0.1s">
                <h2 class="font-serif text-4xl md:text-5xl text-[#2A2421] tracking-tight mt-4">{{ $t['serving']['title'] }}</h2>
            </div>
            <div class="reveal" style="--reveal-delay: 0.18s">
                <p class="text-[#6E635A] text-base md:text-lg leading-relaxed mt-5">{{ $t['serving']['lead'] }}</p>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6 mt-14">
            @foreach ($t['serving']['cards'] as $i => $c)
                @php $img = $i === 0 ? $images['traditionalServing'] : $images['modernServing']; @endphp
                <div class="reveal" style="--reveal-delay: {{ $i * 0.1 }}s">
                    <article data-testid="serving-card-{{ $i }}" class="relative overflow-hidden rounded-3xl border border-[#E5D9C5] group">
                        <img src="{{ $img }}" alt="{{ $c['title'] }}" class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-700" />
                        <div class="p-8">
                            <span class="overline-accent">{{ $c['tag'] }}</span>
                            <h3 class="font-serif text-2xl md:text-3xl text-[#2A2421] mt-2 mb-3">{{ $c['title'] }}</h3>
                            <p class="text-[#6E635A] leading-relaxed">{{ $c['body'] }}</p>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
</section>
