@extends("Layouts.public")

@section('content')

    <section class="min-h-screen bg-slate-100 p-6 md:p-10">

        <div class="max-w-6xl mx-auto">

            {{-- Cabeçalho --}}
            <header class="mb-8">

                <h1 class="text-3xl md:text-4xl font-bold text-slate-800 mt-2">
                    Artistas
                </h1>

                <p class="text-slate-500 mt-2">
                    Descobre quem está por trás das músicas.
                </p>

            </header>

            {{-- Lista de artistas --}}
            @forelse ($artists as $artist)

                @if ($loop->first)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @endif

                <article class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm flex items-center gap-4 hover:border-green-500 transition">

                    {{-- Inicial do nome --}}
                    <div class="bg-green-500 text-white font-bold text-xl rounded-full w-14 h-14 flex items-center justify-center shrink-0">
                        {{ strtoupper(mb_substr($artist['name'] ?? '?', 0, 1)) }}
                    </div>

                    {{-- Nome e descrição --}}
                    <div class="flex-1 min-w-0">

                        <h3 class="text-lg font-bold text-slate-800 truncate">
                            {{ $artist['name'] ?? 'Sem nome' }}
                        </h3>

                        <p class="text-sm text-slate-500 mt-1">
                            {{ \Illuminate\Support\Str::limit($artist['description'] ?? 'Sem descrição', 32) }}
                        </p>

                    </div>

                    {{-- Detalhes --}}
                    <a
                        href="{{ route('lofy.artists.details', $artist['id']) }}"
                        aria-label="Ver detalhes de {{ $artist['name'] ?? 'artista' }}"
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

                    </a>

                </article>

                @if ($loop->last)
                    </div>
                @endif

            @empty

                <div class="bg-white border border-slate-200 rounded-xl p-10 text-center">

                    <h3 class="text-lg font-semibold text-slate-700">
                        Nenhum artista encontrado
                    </h3>

                    <p class="text-slate-500 mt-2">
                        Tenta novamente mais tarde.
                    </p>

                </div>

            @endforelse

        </div>

    </section>

@endsection