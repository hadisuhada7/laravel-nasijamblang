@php
    /** @var array $t */
@endphp

<footer data-testid="footer" class="bg-[#1A140F] text-[#EFE7D9] py-14">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 flex flex-col md:flex-row items-center justify-between gap-6 text-center md:text-left">
        <div class="flex items-center gap-3">
            <i data-lucide="leaf" class="w-7 h-7 text-[#D19C4C]"></i>
            <div>
                <p class="font-serif text-xl">{{ $t['footer']['brand'] }}</p>
                <p class="text-sm text-[#EFE7D9]/55 mt-0.5">{{ $t['footer']['tagline'] }}</p>
            </div>
        </div>
        <p class="text-xs text-[#EFE7D9]/50">{{ $t['footer']['rights'] }}</p>
    </div>
</footer>
