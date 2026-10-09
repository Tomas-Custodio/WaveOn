@extends("Layouts.public")

@section('content')

    <section class="min-h-screen bg-slate-100 p-6 md:p-10">

        <div class="max-w-6xl mx-auto">

            {{-- Cabeçalho --}}
            <header class="mb-8">

                <h1 class="text-3xl md:text-4xl font-bold text-slate-800 mt-2">
                    Pesquisa de músicas
                </h1>

                <p class="text-slate-500 mt-2">
                    Encontra músicas, géneros e artistas para ouvires.
                </p>
            </header>

            {{-- Formulário de pesquisa --}}

            <form action="{{ route('lofy.tracks.search') }}" method="GET"

                  class="flex flex-col sm:flex-row gap-3 mb-10">

                <div class="flex items-center gap-3 flex-1 bg-white border border-slate-200 rounded-xl px-4 py-3 focus-within:border-green-500 focus-within:ring-2 focus-within:ring-green-100">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="1.5"
                         stroke="currentColor"
                         class="size-6 text-slate-400 shrink-0">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>

                    <input
                        type="search"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Pesquisar por músicas, artistas..."
                        class="w-full outline-none bg-transparent text-slate-700 placeholder:text-slate-400"
                    >

                </div>

                <button type="submit"
                        class="flex items-center justify-center gap-2 bg-green-500 hover:bg-green-600 text-white font-semibold px-5 py-3 rounded-xl transition focus-within:bg-blue-500 ">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="1.5"
                         stroke="currentColor"
                         class="size-5">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>

                    Pesquisar
                </button>

            </form>

            {{-- Resultados --}}

            @isset($track_found)

                <div class="mb-5">

                    <h2 class="text-xl font-bold text-slate-800">
                        Resultados da pesquisa
                    </h2>

                    @if (!empty($term))
                        <p class="text-sm text-slate-500 mt-1">
                            Pesquisa por: "{{ $term }}"
                        </p>
                    @endif

                </div>

                @forelse ($track_found as $track)

                    @php
                        $wave = $track['waveform'] ?? [];
                        $max  = count($wave) ? max($wave) : 1;
                        $max  = $max ?: 1;
                        $step = max(1, intdiv(count($wave), 60));
                    @endphp

                    <article
                        class="bg-green-500 border border-slate-200 rounded-xl p-4 md:p-5 shadow-sm flex flex-col md:flex-row md:items-center gap-4 mb-4 w-full text-white"
                    >

                        {{-- Informações da música --}}

                        <div class="flex-1 min-w-0">

                            <h3 class="text-lg font-bold text-slate-800 truncate">
                                {{ $track['title'] ?? 'Sem título' }}
                            </h3>

                            <p class="text-sm text-slate-100 mt-1">
                                {{ $track['genre'] ?? 'Género não disponível' }}
                            </p>

                            <p class="text-xs text-slate-200 mt-1">
                                {{ $track['record_label'] ?? 'Editora não disponível' }}
                            </p>

                        </div>

                        {{-- Reprodução --}}

                        @if (!empty($track['files']['mp3']))

                            <div class="player flex items-center gap-4 w-full md:w-96 md:shrink-0">

                                <button
                                    type="button"
                                    class="play-btn bg-white text-green-600 rounded-full w-10 h-10 shrink-0"
                                >
                                    ▶
                                </button>

                                <div class="wave flex items-center gap-px h-12 flex-1 min-w-0 overflow-hidden cursor-pointer">

                                    @for ($i = 0; $i < count($wave); $i += $step)
                                        <span
                                            class="bar bg-white flex-1 min-w-0 rounded-full opacity-40"
                                            style="height: {{ max(10, ($wave[$i] / $max) * 100) }}%"
                                        ></span>
                                    @endfor

                                </div>

                                <span class="time text-xs w-12 text-right shrink-0 tabular-nums">
                                    {{ gmdate('i:s', (int) ($track['duration'] ?? 0)) }}
                                </span>

                                <audio
                                    src="{{ $track['files']['mp3'] }}"
                                    preload="metadata"
                                ></audio>

                            </div>

                        @endif

                        {{-- Detalhes --}}

                        <a
                            href="{{ route('lofy.tracks.details', $track['id']) }}"
                            aria-label="Ver detalhes de {{ $track['title'] ?? 'música' }}"
                            class="flex items-center justify-center gap-2 shrink-0 bg-slate-100 hover:bg-green-100 text-slate-700 hover:text-green-700 p-3 rounded-lg transition"
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

                    </article>

                @empty

                    <div class="bg-white border border-slate-200 rounded-xl p-10 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.5"
                             stroke="currentColor"
                             class="size-12 text-slate-300 mx-auto mb-3">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>

                        <h3 class="text-lg font-semibold text-slate-700">
                            Nenhuma música encontrada
                        </h3>

                        <p class="text-slate-500 mt-2">
                            Tenta pesquisar com outro nome ou artista.
                        </p>
                    </div>

                @endforelse

            @endisset

        </div>

    </section>

    <script>
        const formatTime = (s) => {
            const m = Math.floor(s / 60);
            const sec = Math.floor(s % 60);
            return String(m).padStart(2, '0') + ':' + String(sec).padStart(2, '0');
        };

        document.querySelectorAll('.player').forEach(player => {

            const audio = player.querySelector('audio');
            const btn   = player.querySelector('.play-btn');
            const wave  = player.querySelector('.wave');
            const bars  = player.querySelectorAll('.bar');
            const time  = player.querySelector('.time');
            const total = time.textContent;

            btn.addEventListener('click', () => {
                audio.paused ? audio.play() : audio.pause();
            });

            audio.addEventListener('play', () => {
                btn.textContent = '⏸';

                // pausa as outras músicas
                document.querySelectorAll('audio').forEach(other => {
                    if (other !== audio) other.pause();
                });
            });

            audio.addEventListener('pause', () => {
                btn.textContent = '▶';
            });

            audio.addEventListener('ended', () => {
                bars.forEach(bar => bar.style.opacity = 0.4);
                time.textContent = total;
            });

            audio.addEventListener('timeupdate', () => {
                const done = Math.floor((audio.currentTime / audio.duration) * bars.length);

                bars.forEach((bar, i) => {
                    bar.style.opacity = i < done ? 1 : 0.4;
                });

                time.textContent = formatTime(audio.currentTime);
            });

            wave.addEventListener('click', (e) => {
                const box = wave.getBoundingClientRect();
                audio.currentTime = ((e.clientX - box.left) / box.width) * audio.duration;
            });

        });
    </script>

@endsection