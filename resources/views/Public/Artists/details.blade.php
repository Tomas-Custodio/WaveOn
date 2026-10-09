@extends('Layouts.public')

@section('content')
    <section class="min-h-screen bg-slate-100">
        {{-- Cabeçalho do artista --}}
        <div class="bg-slate-900 text-white">
            <div class="max-w-6xl mx-auto px-6 py-12 md:py-16">
                <a href="{{ route('lofy.artists.index') }}"
                   class="inline-flex items-center gap-2 text-sm text-slate-300 hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="currentColor"
                         class="size-5">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>
                    Voltar aos artistas
                </a>

                <div class="mt-8 flex flex-col sm:flex-row items-center sm:items-end gap-6">
                    <div class="size-32 md:size-40 rounded-full bg-green-500
                                flex items-center justify-center shrink-0
                                text-5xl font-bold text-white shadow-lg">
                        {{ strtoupper(mb_substr($artist_found['name'] ?? '?', 0, 1)) }}
                    </div>

                    <div class="text-center sm:text-left min-w-0">
                        <p class="text-sm font-semibold uppercase tracking-widest text-green-400">
                            Artista
                        </p>

                        <h1 class="mt-2 text-3xl md:text-5xl font-bold break-words">
                            {{ $artist_found['name'] ?? 'Artista desconhecido' }}
                        </h1>

                        <p class="mt-3 text-slate-300">
                            Descobre o artista e explora a sua música no WaveOn.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Conteúdo --}}
        <div class="max-w-6xl mx-auto px-6 py-10">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Informações --}}
                <article class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                    <h2 class="text-xl font-bold text-slate-800">
                        Sobre o artista
                    </h2>

                    <div class="mt-5 space-y-4">
                        <div>
                            <p class="text-sm text-slate-500">Nome</p>
                            <p class="font-medium text-slate-800">
                                {{ $artist_found['name'] ?? 'Não disponível' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-slate-500">Identificador</p>
                            <p class="font-medium text-slate-800 break-all">
                                {{ $artist_found['id'] ?? 'Não disponível' }}
                            </p>
                        </div>
                    </div>
                </article>

                {{-- Área musical --}}
                <section class="lg:col-span-2 bg-white border border-slate-200
                                rounded-2xl p-6 md:p-8 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="size-11 rounded-xl bg-green-100 text-green-700
                                    flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="currentColor"
                                 class="size-6">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="m9 9 10.5-3v12a3 3 0 1 1-3-3
                                         c1.1 0 2 .6 2.5 1.5V9
                                         l-7.5 2.25V18a3 3 0 1 1-3-3
                                         c1.1 0 2 .6 2.5 1.5V9Z" />
                            </svg>
                        </div>

                        <div>
                            <h2 class="text-xl font-bold text-slate-800">
                                Música do artista
                            </h2>
                            <p class="text-sm text-slate-500">
                                Explora as músicas disponíveis.
                            </p>
                        </div>
                    </div>

                    <div class="mt-8 rounded-xl border border-dashed
                                border-slate-300 p-8 text-center">
                        <p class="font-semibold text-slate-700">
                            Músicas do artista
                        </p>
                        <p class="mt-2 text-sm text-slate-500">
                            Vamos adicionar aqui as músicas associadas
                            a este artista quando confirmarmos os dados
                            disponibilizados pela API.
                        </p>
                    </div>
                </section>

            </div>
        </div>
    </section>
@endsection

