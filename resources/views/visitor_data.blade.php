@php
    use Illuminate\Support\Carbon;
    /** @var string $lang */
    /** @var array  $t */
    /** @var \Illuminate\Pagination\LengthAwarePaginator $visitors */
    /** @var int    $totalAll */
    /** @var string $search */

    $perPage      = $visitors->perPage();
    $currentPage  = $visitors->currentPage();
    $hasResults   = $visitors->total() > 0;
    $isSearching  = $search !== '';
    $localeIso    = $t['locale'] === 'id' ? 'id-ID' : 'en-US';
@endphp
<!doctype html>
<html lang="{{ $lang }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#FDFBF7" />
    <title>{{ $t['title'] }} — Nasi Jamblang</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#FDFBF7] flex flex-col">

    {{-- Header --}}
    <header class="bg-[#FDFBF7]/90 backdrop-blur-xl border-b border-[#E5D9C5] sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 h-20 flex items-center justify-between">
            <a href="{{ route('home', ['lang' => $lang]) }}" class="flex items-center gap-2.5 group" data-testid="logo-link">
                <i data-lucide="leaf" class="w-6 h-6 text-[#2C4C3B] transition-colors group-hover:text-[#D19C4C]"></i>
                <span class="font-serif text-xl tracking-tight text-[#2A2421]">Nasi Jamblang</span>
            </a>
            <div class="flex items-center gap-4">
                <div class="flex items-center rounded-full border border-[#E5D9C5] p-0.5">
                    @foreach (['id', 'en'] as $l)
                        <a href="{{ route('visitor.index', ['lang' => $l, 'q' => $search ?: null]) }}"
                           data-testid="lang-{{ $l }}"
                           class="px-3 py-1 text-xs font-semibold rounded-full transition-all
                                  {{ $l === $lang ? 'bg-[#2C4C3B] text-white' : 'text-[#6E635A] hover:text-[#2C4C3B]' }}">
                            {{ strtoupper($l) }}
                        </a>
                    @endforeach
                </div>
                <a href="{{ route('visitor.form', ['lang' => $lang]) }}"
                   data-testid="link-visitor-form"
                   class="hidden sm:inline-flex items-center gap-1.5 text-sm text-[#6E635A] hover:text-[#2C4C3B] transition-colors">
                    <i data-lucide="clipboard-list" class="w-4 h-4"></i>
                    {{ $lang === 'id' ? 'Form Kunjungan' : 'Visitor Form' }}
                </a>
            </div>
        </div>
    </header>

    {{-- Main --}}
    <main class="flex-1 max-w-7xl mx-auto w-full px-6 lg:px-12 py-12">

        <div class="mb-8">
            <div class="flex items-center gap-3 mb-3">
                <span class="w-8 h-px bg-[#D19C4C]"></span>
                <span class="uppercase tracking-[0.2em] text-xs font-semibold text-[#8B3A23]">{{ $t['overline'] }}</span>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
                <div>
                    <h1 class="font-serif text-4xl text-[#2A2421] leading-tight" data-testid="data-title">{{ $t['title'] }}</h1>
                    <p class="text-[#6E635A] mt-1 text-sm">
                        Total <span class="font-semibold text-[#2C4C3B]" data-testid="total-count">{{ $totalAll }}</span> {{ $t['totalLabel'] }}
                    </p>
                </div>

                <div class="flex items-center gap-3 flex-wrap">
                    <a
                        href="{{ $hasResults ? route('visitor.export', ['lang' => $lang, 'q' => $search ?: null]) : '#' }}"
                        @class([
                            'inline-flex items-center gap-2 bg-[#2C4C3B] text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition-all',
                            'hover:bg-[#3a6050] active:scale-[0.97]' => $hasResults,
                            'opacity-40 cursor-not-allowed pointer-events-none' => ! $hasResults,
                        ])
                        data-testid="export-button"
                    >
                        <i data-lucide="download" class="w-4 h-4"></i>
                        {{ $t['exportBtn'] }}
                    </a>

                    @if ($totalAll > 0)
                        <form
                            action="{{ route('visitor.destroy_all', ['lang' => $lang]) }}"
                            method="POST"
                            onsubmit="return confirm('{{ addslashes($t['confirmDelete']) }}');"
                        >
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                data-testid="delete-all-button"
                                class="inline-flex items-center gap-2 border border-red-200 text-red-500 text-sm font-semibold px-5 py-2.5 rounded-xl hover:bg-red-50 active:scale-[0.97] transition-all"
                            >
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                {{ $t['deleteAllBtn'] }}
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        {{-- Search --}}
        <form method="GET" action="{{ route('visitor.index') }}" class="relative mb-6 max-w-sm" data-testid="search-form">
            <input type="hidden" name="lang" value="{{ $lang }}" />
            <i data-lucide="search" class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-[#B0A498]"></i>
            <input
                type="text"
                name="q"
                value="{{ $search }}"
                placeholder="{{ $t['searchPlaceholder'] }}"
                data-testid="search-input"
                class="w-full h-10 pl-10 pr-4 rounded-xl border border-[#E5D9C5] bg-white text-[#2A2421] placeholder:text-[#C5BAB0] text-sm outline-none focus:ring-2 focus:ring-[#2C4C3B]/20 focus:border-[#2C4C3B] transition-all"
            />
        </form>

        {{-- Table --}}
        <div class="bg-white border border-[#E5D9C5] rounded-2xl overflow-hidden shadow-sm">
            @if ($visitors->isEmpty())
                <div class="flex flex-col items-center justify-center py-24 text-center px-6" data-testid="empty-state">
                    <i data-lucide="users" class="w-12 h-12 text-[#D9CFC6] mb-4" style="stroke-width: 1.2"></i>
                    <p class="font-serif text-xl text-[#2A2421] mb-1">
                        {{ $isSearching ? $t['emptyNoResult'] : $t['emptyNoData'] }}
                    </p>
                    <p class="text-[#B0A498] text-sm">
                        {{ $isSearching ? $t['emptyNoResultDesc'] : $t['emptyNoDataDesc'] }}
                    </p>
                    @if (! $isSearching)
                        <a href="{{ route('visitor.form', ['lang' => $lang]) }}"
                           class="mt-6 inline-flex items-center gap-2 bg-[#2C4C3B] text-white text-sm font-semibold px-5 py-2.5 rounded-xl hover:bg-[#3a6050] transition-all">
                            {{ $t['openForm'] }}
                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                        </a>
                    @endif
                </div>
            @else
                {{-- Mobile cards --}}
                <div class="block md:hidden divide-y divide-[#F2EBE1]">
                    @foreach ($visitors as $idx => $v)
                        @php $rowNum = ($currentPage - 1) * $perPage + $idx + 1; @endphp
                        <div class="px-5 py-4 hover:bg-[#FDFAF5] transition-colors" data-testid="mobile-row-{{ $rowNum }}">
                            <div class="flex items-start justify-between gap-3 mb-2">
                                <span class="font-semibold text-[#2A2421] text-base leading-snug">{{ $v->nama_lengkap }}</span>
                                <span class="text-xs text-[#B0A498] font-medium shrink-0">#{{ $rowNum }}</span>
                            </div>
                            <div class="grid grid-cols-2 gap-x-4 gap-y-1.5 text-sm">
                                <div>
                                    <span class="text-[#B0A498] text-xs uppercase tracking-wider">{{ $t['colCity'] }}</span>
                                    <p class="text-[#4A3F38] mt-0.5">{{ $v->domisili }}</p>
                                </div>
                                <div>
                                    <span class="text-[#B0A498] text-xs uppercase tracking-wider">{{ $t['colDate'] }}</span>
                                    <p class="text-[#6E635A] mt-0.5">{{ Carbon::parse($v->created_at)->locale($t['locale'])->isoFormat('DD MMM YYYY, HH:mm') }}</p>
                                </div>
                                <div class="col-span-2">
                                    <span class="text-[#B0A498] text-xs uppercase tracking-wider">{{ $t['colEmail'] }}</span>
                                    <p class="text-[#4A3F38] mt-0.5 break-all">{{ $v->email }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Desktop table --}}
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full text-sm" data-testid="visitor-table">
                        <thead>
                            <tr class="bg-[#F7F2EA] border-b border-[#E5D9C5]">
                                <th class="text-left px-5 py-3.5 text-xs font-semibold uppercase tracking-wider text-[#6E635A] w-12">{{ $t['colNo'] }}</th>
                                <th class="text-left px-5 py-3.5 text-xs font-semibold uppercase tracking-wider text-[#6E635A]">{{ $t['colName'] }}</th>
                                <th class="text-left px-5 py-3.5 text-xs font-semibold uppercase tracking-wider text-[#6E635A]">{{ $t['colCity'] }}</th>
                                <th class="text-left px-5 py-3.5 text-xs font-semibold uppercase tracking-wider text-[#6E635A]">{{ $t['colEmail'] }}</th>
                                <th class="text-left px-5 py-3.5 text-xs font-semibold uppercase tracking-wider text-[#6E635A] whitespace-nowrap">{{ $t['colDate'] }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($visitors as $idx => $v)
                                @php $rowNum = ($currentPage - 1) * $perPage + $idx + 1; @endphp
                                <tr class="border-b border-[#F2EBE1] hover:bg-[#FDFAF5] transition-colors" data-testid="row-{{ $rowNum }}">
                                    <td class="px-5 py-4 text-[#B0A498] font-medium">{{ $rowNum }}</td>
                                    <td class="px-5 py-4 font-semibold text-[#2A2421]">{{ $v->nama_lengkap }}</td>
                                    <td class="px-5 py-4 text-[#4A3F38]">{{ $v->domisili }}</td>
                                    <td class="px-5 py-4 text-[#4A3F38] break-all">{{ $v->email }}</td>
                                    <td class="px-5 py-4 text-[#6E635A] whitespace-nowrap">
                                        {{ Carbon::parse($v->created_at)->locale($t['locale'])->isoFormat('DD MMM YYYY, HH:mm') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if ($visitors->lastPage() > 1)
                    <div class="flex items-center justify-between px-5 py-4 border-t border-[#F2EBE1]" data-testid="pagination">
                        <p class="text-xs text-[#B0A498]">
                            {{ $t['showing'] }}
                            <span class="text-[#2A2421] font-semibold">{{ $visitors->firstItem() }}</span>
                            {{ $t['to'] }}
                            <span class="text-[#2A2421] font-semibold">{{ $visitors->lastItem() }}</span>
                            {{ $t['of'] }}
                            <span class="text-[#2A2421] font-semibold">{{ $visitors->total() }}</span>
                            {{ $t['entries'] }}
                        </p>

                        <div class="flex items-center gap-1.5">
                            @php
                                $totalPages = $visitors->lastPage();
                                $shown      = collect(range(1, $totalPages))->filter(fn ($p) =>
                                    $p === 1 || $p === $totalPages || abs($p - $currentPage) <= 1
                                )->values()->all();
                                $prevUrl = $visitors->previousPageUrl();
                                $nextUrl = $visitors->nextPageUrl();
                            @endphp

                            <a
                                href="{{ $prevUrl ?: '#' }}"
                                @class([
                                    'w-8 h-8 flex items-center justify-center rounded-lg border border-[#E5D9C5] text-[#6E635A] transition-all',
                                    'hover:bg-[#F7F2EA]' => $prevUrl,
                                    'opacity-40 cursor-not-allowed pointer-events-none' => ! $prevUrl,
                                ])
                                data-testid="pagination-prev"
                            >
                                <i data-lucide="chevron-left" class="w-4 h-4"></i>
                            </a>

                            @foreach ($shown as $i => $p)
                                @if ($i > 0 && $p - $shown[$i - 1] > 1)
                                    <span class="w-8 h-8 flex items-center justify-center text-[#B0A498] text-xs">…</span>
                                @endif
                                <a
                                    href="{{ $visitors->url($p) }}"
                                    @class([
                                        'w-8 h-8 flex items-center justify-center rounded-lg text-sm font-medium transition-all',
                                        'bg-[#2C4C3B] text-white' => $p === $currentPage,
                                        'border border-[#E5D9C5] text-[#6E635A] hover:bg-[#F7F2EA]' => $p !== $currentPage,
                                    ])
                                    data-testid="page-{{ $p }}"
                                >
                                    {{ $p }}
                                </a>
                            @endforeach

                            <a
                                href="{{ $nextUrl ?: '#' }}"
                                @class([
                                    'w-8 h-8 flex items-center justify-center rounded-lg border border-[#E5D9C5] text-[#6E635A] transition-all',
                                    'hover:bg-[#F7F2EA]' => $nextUrl,
                                    'opacity-40 cursor-not-allowed pointer-events-none' => ! $nextUrl,
                                ])
                                data-testid="pagination-next"
                            >
                                <i data-lucide="chevron-right" class="w-4 h-4"></i>
                            </a>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </main>

    <div class="h-1.5 w-full bg-gradient-to-r from-[#2C4C3B] via-[#D19C4C] to-[#8B3A23]"></div>

</body>
</html>
