@extends('Layouts.public')

@section('content')

    <section class="min-h-screen bg-slate-100 p-6 md:p-10">

        <div class="max-w-5xl mx-auto">

            {{-- Voltar --}}
            
            <a href="{{ url()->previous() }}"
               class="inline-flex items-center gap-2 text-slate-600 hover:text-green-600 transition mb-6">

                <svg xmlns="http://www.w3.org/2000/svg"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke-width="1.5"
                     stroke="currentColor"
                     class="size-5">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>

                Voltar
            </a>

            <article class="bg-white rounded-2xl shadow-lg overflow-hidden">

                {{-- Cabeçalho --}}
                <div class="bg-green-500 p-8 text-white">

                    <p class="text-sm uppercase tracking-widest text-green-100">
                        Detalhes da música
                    </p>

                    <h1 class="text-3xl md:text-4xl font-bold mt-2">
                        {{ $track_found['title'] }}
                    </h1>

                    <p class="mt-3 text-green-100">
                        {{ $track_found['genre'] ?? 'Género não disponível' }}
                    </p>

                </div>

                <div class="p-6 md:p-8 space-y-8">

                    {{-- Reprodução --}}
                    <section>
                        <h2 class="text-lg font-bold text-slate-800 mb-4">
                            Ouvir música
                        </h2>

                        @if (!empty($track_found['files']['mp3']))

                            @php
                                $wave = $track_found['waveform'] ?? [];
                                $max  = count($wave) ? max($wave) : 1;
                                $max  = $max ?: 1;
                                $step = max(1, intdiv(count($wave), 100));
                            @endphp

                            <div class="player flex items-center gap-4 bg-slate-50 rounded-xl px-4 py-3">

                                <button
                                    type="button"
                                    class="play-btn bg-green-500 hover:bg-green-600 text-white rounded-full w-10 h-10 shrink-0 transition"
                                >
                                    ▶
                                </button>

                                <div class="wave flex items-center gap-px h-10 flex-1 min-w-0 overflow-hidden cursor-pointer">

                                    @for ($i = 0; $i < count($wave); $i += $step)
                                        <span
                                            class="bar bg-green-500 flex-1 min-w-0 rounded-full opacity-30"
                                            style="height: {{ max(12, ($wave[$i] / $max) * 100) }}%"
                                        ></span>
                                    @endfor

                                </div>

                                <span class="time text-xs text-slate-600 w-12 text-right shrink-0 tabular-nums">
                                    {{ gmdate('i:s', (int) ($track_found['duration'] ?? 0)) }}
                                </span>

                                <audio
                                    src="{{ $track_found['files']['mp3'] }}"
                                    preload="metadata"
                                ></audio>

                            </div>

                        @else
                            <p class="text-slate-500">Áudio não disponível.</p>
                        @endif
                    </section>

                    {{-- Informações --}}
                    <section>
                        <h2 class="text-lg font-bold text-slate-800 mb-4">
                            Informações
                        </h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                            <div class="rounded-lg bg-slate-50 p-4">
                                <p class="text-sm text-slate-500">Título</p>
                                <p class="font-semibold text-slate-800 mt-1">
                                    {{ $track_found['title'] }}
                                </p>
                            </div>

                            <div class="rounded-lg bg-slate-50 p-4">
                                <p class="text-sm text-slate-500">Género</p>
                                <p class="font-semibold text-slate-800 mt-1">
                                    {{ $track_found['genre'] ?? 'Não disponível' }}
                                </p>
                            </div>

                            <div class="rounded-lg bg-slate-50 p-4">
                                <p class="text-sm text-slate-500">Editora</p>
                                <p class="font-semibold text-slate-800 mt-1">
                                    {{ $track_found['record_label'] ?? 'Não disponível' }}
                                </p>
                            </div>

                            <div class="rounded-lg bg-slate-50 p-4">
                                <p class="text-sm text-slate-500">Duração</p>
                                <p class="font-semibold text-slate-800 mt-1">
                                    {{ isset($track_found['duration']) ? gmdate('i:s', $track_found['duration']) : 'Não disponível' }}
                                </p>
                            </div>

                            <div class="rounded-lg bg-slate-50 p-4">
                                <p class="text-sm text-slate-500">Reproduções</p>
                                <p class="font-semibold text-slate-800 mt-1">
                                    {{ number_format($track_found['plays'] ?? 0, 0, ',', '.') }}
                                </p>
                            </div>

                            <div class="rounded-lg bg-slate-50 p-4">
                                <p class="text-sm text-slate-500">Downloads</p>
                                <p class="font-semibold text-slate-800 mt-1">
                                    {{ number_format($track_found['downloads'] ?? 0, 0, ',', '.') }}
                                </p>
                            </div>

                        </div>
                    </section>

                    {{-- Artistas --}}
                    @if (!empty($track['artists']))
                        <section>
                            <h2 class="text-lg font-bold text-slate-800 mb-4">
                                Artistas
                            </h2>

                            <div class="flex flex-wrap gap-2">
                                @foreach ($track_found['artists'] as $artist)
                                    <span class="bg-green-100 text-green-800 px-3 py-2 rounded-full text-sm font-medium">
                                        {{ is_array($artist) ? ($artist['name'] ?? 'Artista') : $artist }}
                                    </span>
                                @endforeach
                            </div>
                        </section>
                    @endif

                    {{-- Categorias --}}
                    @if (!empty($track_found['categories']))
                        <section>
                            <h2 class="text-lg font-bold text-slate-800 mb-4">
                                Categorias
                            </h2>

                            <div class="flex flex-wrap gap-2">
                                @foreach ($track_found['categories'] as $category)
                                    <span class="bg-slate-100 text-slate-700 px-3 py-2 rounded-full text-sm">
                                        {{ is_array($category) ? ($category['name'] ?? 'Categoria') : $category }}
                                    </span>
                                @endforeach
                            </div>
                        </section>
                    @endif

                </div>

            </article>

        </div>

    </section>

    <script>
        const formatTime = (s) => {
            const m = Math.floor(s / 60);
            const sec = Math.floor(s % 60);
            return String(m).padStart(2, '0') + ':' + String(sec).padStart(2, '0');
        };

        const player = document.querySelector('.player');

        if (player) {

            const audio = player.querySelector('audio');
            const btn   = player.querySelector('.play-btn');
            const wave  = player.querySelector('.wave');
            const bars  = player.querySelectorAll('.bar');
            const time  = player.querySelector('.time');
            const total = time.textContent;

            btn.addEventListener('click', () => {
                audio.paused ? audio.play() : audio.pause();
            });

            audio.addEventListener('play',  () => btn.textContent = '⏸');
            audio.addEventListener('pause', () => btn.textContent = '▶');

            audio.addEventListener('ended', () => {
                bars.forEach(bar => bar.style.opacity = 0.3);
                time.textContent = total;
            });

            audio.addEventListener('timeupdate', () => {
                const done = Math.floor((audio.currentTime / audio.duration) * bars.length);

                bars.forEach((bar, i) => {
                    bar.style.opacity = i < done ? 1 : 0.3;
                });

                time.textContent = formatTime(audio.currentTime);
            });

            wave.addEventListener('click', (e) => {
                const box = wave.getBoundingClientRect();
                audio.currentTime = ((e.clientX - box.left) / box.width) * audio.duration;
            });
        }
    </script>

@endsection