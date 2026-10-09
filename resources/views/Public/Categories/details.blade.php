@extends('Layouts.public')

@section('content')

    {{-- DETALHES DA CATEGORIA --}}

    <section class="max-w-6xl mx-auto p-6">

        <article class="bg-slate-900 text-white rounded-xl shadow-lg overflow-hidden">

            {{-- Capa --}}
            <div
                class="h-64 md:h-96 bg-cover bg-center"
                style="background-image: url('{{ $category_found['thumbnails']['lg'] ?? '' }}')"
            >
                <div class="h-full flex items-end p-6 bg-gradient-to-t from-black/80 to-transparent">
                    <div>
                        <p class="text-sm uppercase tracking-widest text-green-400">
                            {{ $category_found['type'] ?? 'Categoria' }}
                        </p>

                        <h1 class="text-3xl md:text-5xl font-bold mt-2">
                            {{ $category_found['name'] ?? 'Sem nome' }}
                        </h1>
                    </div>
                </div>
            </div>

            {{-- Descrição e informações --}}
            <div class="p-6 md:p-8">

                <h2 class="text-xl font-bold mb-3">
                    Sobre esta categoria
                </h2>

                <p class="text-slate-300 leading-7">
                    {{ $category_found['description'] ?? 'Sem descrição disponível.' }}
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-8">

                    <div class="bg-slate-800 rounded-lg p-4">
                        <p class="text-sm text-slate-400">Visualizações</p>
                        <p class="text-xl font-bold mt-1">
                            {{ number_format($category_found['views'] ?? 0, 0, ',', '.') }}
                        </p>
                    </div>

                    <div class="bg-slate-800 rounded-lg p-4">
                        <p class="text-sm text-slate-400">Tipo</p>
                        <p class="text-xl font-bold mt-1">
                            {{ $category_found['type'] ?? 'Não disponível' }}
                        </p>
                    </div>

                    <div class="bg-slate-800 rounded-lg p-4">
                        <p class="text-sm text-slate-400">Data de publicação</p>
                        <p class="text-lg font-bold mt-1">
                            {{ !empty($category_found['upload_date'])
                                ? \Illuminate\Support\Carbon::parse($category_found['upload_date'])->format('d/m/Y')
                                : 'Não disponível' }}
                        </p>
                    </div>

                </div>

                {{-- Voltar às categorias --}}
                
                <
        {{-- Botão fixo para voltar às categorias --}}

        <a
            href="{{ route('categories.index') }}"
            title="Voltar às categorias"
            aria-label="Voltar às categorias"
            class="fixed right-0 top-1/2 -translate-y-1/2 z-50
                flex items-center justify-center
                bg-green-500 hover:bg-green-600
                text-white p-4 rounded-l-xl shadow-lg
                transition-all duration-300 hover:pr-6">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="2"
                stroke="currentColor"
                class="w-6 h-6">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M15.75 19.5 8.25 12l7.5-7.5"/>

            </svg>
        
            </a>

        </div>

    </article>

</section>


    {{-- MÚSICAS DA CATEGORIA --}}

    <section class="max-w-6xl mx-auto px-6 pb-12">

            {{-- Título sempre à esquerda --}}

            <header class="mb-8 text-left">

                <h2 class="text-2xl md:text-3xl font-bold text-slate-800">
                    Músicas desta categoria
                </h2>

                <p class="text-slate-500 mt-2">
                    Explora as músicas e ouve as tuas favoritas.
                </p>
            </header>

        {{-- Cards centrados dentro do container --}}

        {{-- CONTAINER DAS MÚSICAS --}}

        <div class="w-full flex flex-col items-center gap-4">

            @forelse ($category_tracks ?? [] as $track)

                @if (is_array($track) && isset($track['id']))

                    @php
                        $wave = is_array($track['waveform'] ?? null)
                            ? $track['waveform']
                            : [];

                        $max = count($wave) ? max($wave) : 1;
                        $max = $max ?: 1;
                        $step = max(1, (int) ceil(count($wave) / 60));

                        $mp3 = $track['files']['mp3'] ?? null;
                    @endphp

                    {{-- CARD DA MÚSICA --}}
                    <article
                        class="w-full min-w-0 bg-green-500 border border-green-600 rounded-xl p-4 md:p-5 shadow-sm"
                    >

                        <div class="flex flex-col md:flex-row md:items-center gap-4 w-full min-w-0">

                            {{-- INFORMAÇÕES --}}
                            <div class="w-full md:flex-1 md:min-w-0">

                                <h3 class="text-lg font-bold text-white truncate">
                                    {{ $track['title'] ?? 'Sem título' }}
                                </h3>

                                <p class="text-sm text-green-50 mt-1 truncate">
                                    {{ $track['genre'] ?? 'Género não disponível' }}
                                </p>

                                <p class="text-xs text-green-100 mt-1 truncate">
                                    {{ $track['record_label'] ?? 'Editora não disponível' }}
                                </p>

                            </div>

                            {{-- PLAYER DE ÁUDIO --}}
                            @if ($mp3)

                                <div class="player flex items-center gap-3 w-full md:w-80 lg:w-96 md:shrink-0 min-w-0">

                                    <button
                                        type="button"
                                        class="play-btn flex items-center justify-center bg-white text-green-700 rounded-full w-10 h-10 shrink-0 hover:bg-green-100 transition"
                                        aria-label="Reproduzir ou pausar"
                                    >
                                        ▶
                                    </button>

                                    {{-- WAVEFORM --}}
                                    <div
                                        class="wave flex items-center gap-px h-12 flex-1 min-w-0 overflow-hidden cursor-pointer"
                                        title="Clica para avançar na música"
                                    >
                                        @for ($i = 0; $i < count($wave); $i += $step)
                                            <span
                                                class="bar bg-white flex-1 min-w-0 rounded-full opacity-50"
                                                style="height: {{ max(10, ($wave[$i] / $max) * 100) }}%"
                                            ></span>
                                        @endfor
                                    </div>

                                    {{-- TEMPO --}}
                                    <span class="time text-xs w-12 text-right shrink-0 tabular-nums text-white">
                                        {{ gmdate('i:s', (int) ($track['duration'] ?? 0)) }}
                                    </span>

                                    <audio src="{{ $mp3 }}" preload="metadata"></audio>

                                </div>

                            @endif

                            {{-- BOTÃO DE DETALHES --}}
                            <a
                                href="{{ route('lofy.tracks.details', $track['id']) }}"
                                aria-label="Ver detalhes de {{ $track['title'] ?? 'música' }}"
                                class="flex items-center justify-center gap-2 shrink-0 bg-white hover:bg-green-100 text-green-700 p-3 rounded-lg transition"
                            >

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="size-6"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M2.25 12s3.75-6.75 9.75-6.75S21.75 12 21.75 12 18 18.75 12 18.75 2.25 12 2.25 12Z"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                                    />
                                </svg>

                                <span class="md:hidden">
                                    Detalhes
                                </span>

                            </a>

                        </div>
                    </article>

                @endif

            @empty

                <div class="w-full bg-white border border-slate-200 rounded-xl p-10 text-center">
                    <h3 class="text-lg font-semibold text-slate-700">
                        Nenhuma música encontrada
                    </h3>

                    <p class="text-slate-500 mt-2">
                        Esta categoria ainda não tem músicas disponíveis.
                    </p>
                </div>

            @endforelse

        </div>
        
    </section>


    {{-- CONTROLOS DO PLAYER --}}
    <script>
        const formatTime = (s) => {
            const m = Math.floor(s / 60);
            const sec = Math.floor(s % 60);

            return String(m).padStart(2, '0') + ':' +
                   String(sec).padStart(2, '0');
        };

        document.querySelectorAll('.player').forEach(player => {
            const audio = player.querySelector('audio');
            const btn = player.querySelector('.play-btn');
            const wave = player.querySelector('.wave');
            const bars = player.querySelectorAll('.bar');
            const time = player.querySelector('.time');
            const total = time.textContent.trim();

            btn.addEventListener('click', () => {
                if (audio.paused) {
                    audio.play().catch(error => {
                        console.error('Não foi possível reproduzir a música:', error);
                    });
                } else {
                    audio.pause();
                }
            });

            audio.addEventListener('play', () => {
                document.querySelectorAll('.player audio').forEach(other => {
                    if (other !== audio) {
                        other.pause();
                    }
                });

                btn.textContent = '⏸';
            });

            audio.addEventListener('pause', () => {
                btn.textContent = '▶';
            });

            audio.addEventListener('ended', () => {
                bars.forEach(bar => bar.style.opacity = 0.5);
                time.textContent = total;
                btn.textContent = '▶';
            });

            audio.addEventListener('timeupdate', () => {
                if (!Number.isFinite(audio.duration) || audio.duration <= 0) {
                    return;
                }

                const done = Math.floor(
                    (audio.currentTime / audio.duration) * bars.length
                );

                bars.forEach((bar, i) => {
                    bar.style.opacity = i < done ? 1 : 0.5;
                });

                time.textContent = formatTime(audio.currentTime);
            });

            wave.addEventListener('click', (e) => {
                if (!Number.isFinite(audio.duration) || audio.duration <= 0) {
                    return;
                }

                const box = wave.getBoundingClientRect();

                if (box.width <= 0) {
                    return;
                }

                audio.currentTime =
                    ((e.clientX - box.left) / box.width) * audio.duration;
            });
        });
    </script>

@endsection

