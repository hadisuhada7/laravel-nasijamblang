@php
    /** @var array $t */
@endphp

<section id="nutrition" data-testid="nutrition-section" class="py-24 md:py-32 bg-[#F2EBE1]">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="grid lg:grid-cols-2 gap-14 items-start">
            <div>
                <div class="reveal">
                    <span class="overline-accent" data-testid="section-overline">{{ $t['nutrition']['overline'] }}</span>
                </div>
                <div class="reveal" style="--reveal-delay: 0.1s">
                    <h2 class="font-serif text-4xl md:text-5xl text-[#2A2421] tracking-tight mt-4">{{ $t['nutrition']['title'] }}</h2>
                </div>
                <div class="reveal" style="--reveal-delay: 0.18s">
                    <p class="text-[#6E635A] text-base md:text-lg leading-relaxed mt-5">{{ $t['nutrition']['lead'] }}</p>
                </div>

                <div class="reveal" style="--reveal-delay: 0.24s">
                    <div data-testid="nutrition-table" class="mt-8 bg-[#FDFBF7] border border-[#E5D9C5] rounded-2xl p-7">
                        <h3 class="text-xs uppercase tracking-[0.18em] text-[#8B3A23] font-semibold">{{ $t['nutrition']['tableTitle'] }}</h3>
                        <table class="w-full mt-5">
                            <tbody>
                                @foreach ($t['nutrition']['table'] as $i => $row)
                                    <tr data-testid="nutrition-row-{{ $i }}" class="border-b border-[#E5D9C5] last:border-0">
                                        <td class="py-4 text-[#2A2421] font-medium">{{ $row['k'] }}</td>
                                        <td class="py-4 text-right font-serif text-xl text-[#2C4C3B]">{{ $row['v'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="space-y-5 lg:pt-16">
                @foreach ($t['nutrition']['sources'] as $i => $s)
                    <div class="reveal" style="--reveal-delay: {{ $i * 0.1 }}s">
                        <article data-testid="nutrition-source-{{ $i }}" class="bg-[#FDFBF7] border border-[#E5D9C5] rounded-2xl p-7 hover:border-[#2C4C3B] transition-colors">
                            <span class="overline-accent">{{ $s['title'] }}</span>
                            <h3 class="font-serif text-2xl text-[#2A2421] mt-1.5 mb-2">{{ $s['item'] }}</h3>
                            <p class="text-sm text-[#6E635A] leading-relaxed">{{ $s['body'] }}</p>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
