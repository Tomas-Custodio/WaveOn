
@extends("Layouts.public")

@section('content')

<section class="max-w-6xl mx-auto p-6">

    <article class="bg-slate-900 text-white rounded-xl shadow-lg overflow-hidden">

        {{-- Capa da categoria --}}

        <div
            class="h-64 md:h-96 bg-cover bg-center"
            style="background-image: url('{{ $category_found['thumbnails']['lg'] }}')"
        >
            <div class="h-full flex items-end p-6 bg-gradient-to-t from-black/80 to-transparent">

                <div>
                    <p class="text-sm uppercase tracking-widest text-green-400">
                        {{ $category_found['type'] }}
                    </p>

                    <h1 class="text-3xl md:text-5xl font-bold mt-2">
                        {{ $category_found['name'] }}
                    </h1>
                </div>

            </div>
        </div>

        {{-- Descrição --}}
        <div class="p-6 md:p-8">

            <h2 class="text-xl font-bold mb-3">
                Sobre esta categoria
            </h2>

            <p class="text-slate-300 leading-7">
                {{ $category_found['description'] ?: 'Sem descrição disponível.' }}
            </p>

            {{-- Informações --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-8">

                <div class="bg-slate-800 rounded-lg p-4">
                    <p class="text-sm text-slate-400">Visualizações</p>
                    <p class="text-xl font-bold mt-1">
                        {{ number_format($category_found['views'], 0, ',', '.') }}
                    </p>
                </div>

                <div class="bg-slate-800 rounded-lg p-4">
                    <p class="text-sm text-slate-400">Tipo</p>
                    <p class="text-xl font-bold mt-1">
                        {{ $category_found['type'] }}
                    </p>
                </div>

                <div class="bg-slate-800 rounded-lg p-4">
                    <p class="text-sm text-slate-400">Data de publicação</p>
                    <p class="text-lg font-bold mt-1">
                        {{ \Illuminate\Support\Carbon::parse($category_found['upload_date'])->format('d/m/Y') }}
                    </p>
                </div>

            </div>

            {{-- Navegação --}}
            <div class="mt-8">
                <a
                    href="{{ route('lofy.categories.index') }}"
                    class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white font-semibold px-5 py-3 rounded-lg transition"
                >
                    <span>&larr;</span>
                    Voltar às categorias
                </a>
            </div>

        </div>

    </article>

</section>

@endsection

