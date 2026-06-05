@php
    /** @var array $t */
    /** @var array $images */
@endphp

<section id="tasting" data-testid="tasting-section" class="py-24 md:py-32 bg-[#3A1E14] text-[#F2EBE1] relative overflow-hidden">
    <div class="absolute -right-20 -top-20 w-96 h-96 rounded-full bg-[#8B3A23]/30 blur-3xl"></div>
    <div class="relative max-w-7xl mx-auto px-6 lg:px-12">
        <div class="grid lg:grid-cols-2 gap-14 items-center">
            <div>
                <div class="reveal">
                    <span class="inline-flex items-center gap-2 text-[#E6C58A] uppercase tracking-[0.2em] text-xs font-semibold">
                        <span class="w-8 h-px bg-[#D19C4C]"></span> {{ $t['tasting']['overline'] }}
                    </span>
                </div>
                <div class="reveal" style="--reveal-delay: 0.1s">
                    <h2 class="font-serif text-4xl md:text-5xl tracking-tight mt-4">{{ $t['tasting']['title'] }}</h2>
                </div>
                <div class="reveal" style="--reveal-delay: 0.18s">
                    <p class="text-[#EADFCF]/85 leading-relaxed mt-5 text-base md:text-lg">{{ $t['tasting']['lead'] }}</p>
                </div>

                <div class="mt-9 space-y-4">
                    @foreach ($t['tasting']['notes'] as $i => $n)
                        <div class="reveal" style="--reveal-delay: {{ 0.24 + $i * 0.08 }}s">
                            <div data-testid="tasting-note-{{ $i }}" class="flex items-start gap-4 border-l-2 border-[#D19C4C] pl-5">
                                <div>
                                    <h4 class="font-serif text-xl text-[#F2EBE1]">{{ $n['label'] }}</h4>
                                    <p class="text-sm text-[#EADFCF]/70 mt-1">{{ $n['desc'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="reveal" style="--reveal-delay: 0.2s">
                <div class="relative">
                    <div class="rounded-3xl overflow-hidden border border-[#F2EBE1]/15">
                        <img src="{{ $images['hero'] }}" alt="Tasting Nasi Jamblang" class="w-full h-[440px] object-cover" />
                    </div>
                    <div data-testid="tasting-aroma" class="absolute -bottom-6 -left-4 right-8 bg-[#2C4C3B] rounded-2xl p-6 shadow-xl border border-[#F2EBE1]/10">
                        <h4 class="font-serif text-xl text-[#E6C58A]">{{ $t['tasting']['aromaTitle'] }}</h4>
                        <p class="text-sm text-[#EFE7D9]/85 leading-relaxed mt-2">{{ $t['tasting']['aromaBody'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
