@extends("Layouts.public")

@section('content')

<section class="max-w-7xl mx-auto p-6">

    {{-- Cabeçalho --}}

    <header class="mb-8">

        <h1 class="text-2xl md:text-3xl text-slate-900 mt-2">
            Categorias de música
        </h1>

        <p class="text-slate-500 mt-2 text-sm hover:underline cursor-pointer">
            Explora diferentes categorias e encontra a música ideal para os teus projetos.
        </p>
    </header>

    {{-- Lista de categorias --}}
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        @forelse ($categories as $category)

            <article class="group rounded-xl overflow-hidden bg-slate-900 shadow-md hover:shadow-xl transition duration-300">

                {{-- Imagem e informações --}}
                <div
                    class="relative h-56 bg-cover bg-center transition duration-500 group-hover:scale-105"
                    style="background-image: url('{{ $category['thumbnails']['lg'] ?? $category['thumbnails']['sm'] ?? '' }}')"
                >
                    {{-- Camada escura --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent"></div>

                    {{-- Conteúdo --}}
                    <div class="absolute inset-0 flex flex-col justify-end p-5">

                        <span class="text-xs font-bold uppercase tracking-widest text-green-400">
                            {{ $category['type'] ?? 'Categoria' }}
                        </span>

                        <h2 class="text-2xl font-bold text-white mt-1">
                            {{ $category['name'] }}
                        </h2>

                        <p class="text-sm text-slate-300 mt-2">
                            {{ number_format($category['views'] ?? 0, 0, ',', '.') }}
                            visualizações
                        </p>

                    </div>
                </div>

                {{-- Rodapé do cartão --}}
                <div class="flex items-center justify-between gap-3 p-4">

                    <p class="text-sm text-slate-400">
                        {{ Str::limit($category['description'],32) }}
                    </p>

                    <a
                        href="{{ route('lofy.categories.details', $category['id']) }}"
                        aria-label="Ver detalhes de {{ $category['name'] }}"
                        class="shrink-0 inline-flex items-center justify-center gap-2 rounded-lg bg-green-500 px-3 py-2 text-sm font-semibold text-white hover:bg-green-600 transition"
                    >
                        Detalhes

                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                            class="size-5">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>

                </div>

            </article>

        @empty

            <div class="col-span-full rounded-xl border border-slate-200 bg-slate-50 p-10 text-center">
                <h2 class="text-xl font-semibold text-slate-800">
                    Nenhuma categoria encontrada
                </h2>

                <p class="text-slate-500 mt-2">
                    Não existem categorias disponíveis neste momento.
                </p>
            </div>

        @endforelse

    </section>

</section>

@endsection

