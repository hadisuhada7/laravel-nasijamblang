@php
    /** @var string $lang */
    /** @var array  $t */
    $otherLang = $lang === 'id' ? 'en' : 'id';
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
                        <a href="{{ route('visitor.form', ['lang' => $l]) }}"
                           data-testid="lang-{{ $l }}"
                           class="px-3 py-1 text-xs font-semibold rounded-full transition-all
                                  {{ $l === $lang ? 'bg-[#2C4C3B] text-white' : 'text-[#6E635A] hover:text-[#2C4C3B]' }}">
                            {{ strtoupper($l) }}
                        </a>
                    @endforeach
                </div>
                <a href="{{ route('visitor.index', ['lang' => $lang]) }}"
                   data-testid="link-visitor-data"
                   class="hidden sm:inline-flex items-center gap-1.5 text-sm text-[#6E635A] hover:text-[#2C4C3B] transition-colors">
                    <i data-lucide="layout-list" class="w-4 h-4"></i>
                    {{ $lang === 'id' ? 'Data Pengunjung' : 'Visitor Data' }}
                </a>
            </div>
        </div>
    </header>

    {{-- Main --}}
    <main class="flex-1 flex items-center justify-center px-6 py-16">
        <div class="w-full max-w-lg">

            <div class="flex items-center gap-3 mb-4">
                <span class="w-8 h-px bg-[#D19C4C]"></span>
                <span class="uppercase tracking-[0.2em] text-xs font-semibold text-[#8B3A23]">{{ $t['overline'] }}</span>
            </div>

            <h1 class="font-serif text-4xl md:text-5xl text-[#2A2421] leading-tight mb-3" data-testid="form-title">
                {{ $t['title'] }}
            </h1>
            <p class="text-[#6E635A] text-base leading-relaxed mb-10">{{ $t['subtitle'] }}</p>

            <form
                action="{{ route('visitor.store', ['lang' => $lang]) }}"
                method="POST"
                novalidate
                x-data="{ submitting: false }"
                @submit="submitting = true"
                class="space-y-6"
                data-testid="visitor-form"
            >
                @csrf

                {{-- Nama Lengkap --}}
                <div>
                    <label for="nama_lengkap" class="flex items-center gap-2 text-sm font-semibold text-[#2A2421] mb-2">
                        <i data-lucide="user" class="w-4 h-4 text-[#2C4C3B]"></i>
                        {{ $t['labelName'] }}
                        <span class="text-[#8B3A23]">*</span>
                    </label>
                    <input
                        id="nama_lengkap"
                        name="nama_lengkap"
                        type="text"
                        autocomplete="name"
                        value="{{ old('nama_lengkap') }}"
                        placeholder="{{ $t['placeholderName'] }}"
                        data-testid="input-name"
                        class="w-full h-12 px-4 rounded-xl border bg-white text-[#2A2421] placeholder:text-[#C5BAB0] text-sm transition-all outline-none focus:ring-2 focus:ring-[#2C4C3B]/20 focus:border-[#2C4C3B] {{ $errors->has('nama_lengkap') ? 'border-red-400 focus:border-red-400 focus:ring-red-200' : 'border-[#E5D9C5]' }}"
                    />
                    @error('nama_lengkap')
                        <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1" data-testid="error-name">
                            <span class="w-1 h-1 rounded-full bg-red-500 inline-block"></span>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Domisili --}}
                <div>
                    <label for="domisili" class="flex items-center gap-2 text-sm font-semibold text-[#2A2421] mb-2">
                        <i data-lucide="map-pin" class="w-4 h-4 text-[#2C4C3B]"></i>
                        {{ $t['labelCity'] }}
                        <span class="text-[#8B3A23]">*</span>
                    </label>
                    <input
                        id="domisili"
                        name="domisili"
                        type="text"
                        autocomplete="address-level2"
                        value="{{ old('domisili') }}"
                        placeholder="{{ $t['placeholderCity'] }}"
                        data-testid="input-city"
                        class="w-full h-12 px-4 rounded-xl border bg-white text-[#2A2421] placeholder:text-[#C5BAB0] text-sm transition-all outline-none focus:ring-2 focus:ring-[#2C4C3B]/20 focus:border-[#2C4C3B] {{ $errors->has('domisili') ? 'border-red-400 focus:border-red-400 focus:ring-red-200' : 'border-[#E5D9C5]' }}"
                    />
                    @error('domisili')
                        <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1" data-testid="error-city">
                            <span class="w-1 h-1 rounded-full bg-red-500 inline-block"></span>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="flex items-center gap-2 text-sm font-semibold text-[#2A2421] mb-2">
                        <i data-lucide="mail" class="w-4 h-4 text-[#2C4C3B]"></i>
                        {{ $t['labelEmail'] }}
                        <span class="text-[#8B3A23]">*</span>
                    </label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        autocomplete="email"
                        value="{{ old('email') }}"
                        placeholder="{{ $t['placeholderEmail'] }}"
                        data-testid="input-email"
                        class="w-full h-12 px-4 rounded-xl border bg-white text-[#2A2421] placeholder:text-[#C5BAB0] text-sm transition-all outline-none focus:ring-2 focus:ring-[#2C4C3B]/20 focus:border-[#2C4C3B] {{ $errors->has('email') ? 'border-red-400 focus:border-red-400 focus:ring-red-200' : 'border-[#E5D9C5]' }}"
                    />
                    @error('email')
                        <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1" data-testid="error-email">
                            <span class="w-1 h-1 rounded-full bg-red-500 inline-block"></span>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Submit --}}
                <button
                    type="submit"
                    :disabled="submitting"
                    data-testid="submit-button"
                    class="w-full py-3.5 inline-flex items-center justify-center gap-2 bg-[#2C4C3B] text-white font-semibold rounded-xl hover:bg-[#3a6050] active:scale-[0.98] transition-all disabled:opacity-60 disabled:cursor-not-allowed text-sm"
                >
                    <template x-if="!submitting">
                        <span class="inline-flex items-center gap-2">
                            {{ $t['submit'] }}
                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                        </span>
                    </template>
                    <template x-if="submitting">
                        <span class="inline-flex items-center gap-2">
                            <span class="w-4 h-4 border-2 border-white/30 border-t-white rounded-full animate-spin"></span>
                            {{ $t['submitting'] }}
                        </span>
                    </template>
                </button>
            </form>

            <p class="mt-8 text-center text-xs text-[#B0A498]">{{ $t['privacy'] }}</p>
        </div>
    </main>

    <div class="h-1.5 w-full bg-gradient-to-r from-[#2C4C3B] via-[#D19C4C] to-[#8B3A23]"></div>

</body>
</html>
