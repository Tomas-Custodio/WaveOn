@extends('Layouts.public')

@section('content')

    <section class="p-5 bg-slate-200 flex items-center justify-between">

        <h1 class="text-xl md:text-3xl font-bold">
            Old tracks
        </h1>

        <select
            onchange="if (this.value) window.location.href = this.value"
            class="border-none outline-solid rounded-md w-48 p-2"
        >
            <option
                value="{{ route('lofy.tracks.recents') }}"
                @selected(request()->routeIs('lofy.tracks.recents'))
            >
                Recents
            </option>

            <option
                value="{{ route('lofy.tracks.olds') }}"
                @selected(request()->routeIs('lofy.tracks.olds'))
            >
                Olds
            </option>

        </select>

    </section>

    <section class="flex flex-col items-center p-9 gap-3 bg-slate-50">

        @foreach ($tracks as $track)

            @php
                $wave = $track['waveform'] ?? [];
                $max  = count($wave) ? max($wave) : 1;
                $max  = $max ?: 1;
                $step = max(1, intdiv(count($wave), 60));
            @endphp

            <article
                class="bg-green-500 border border-slate-200 rounded-xl p-4 md:p-5 shadow-sm flex flex-col md:flex-row md:items-center gap-4 mb-4 w-9/12 text-white"
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

        @endforeach

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