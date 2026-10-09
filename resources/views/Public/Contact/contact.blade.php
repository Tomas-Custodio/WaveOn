
@extends('Layouts.public')

@section('content')

<section class="min-h-screen bg-slate-950 py-16 px-6">
    <div class="max-w-6xl mx-auto">

        {{-- CABEÇALHO --}}
        <header class="text-center mb-12">
            <p class="text-green-400 font-semibold uppercase tracking-[0.3em] text-sm">
                Encontra-me online
            </p>

            <h1 class="text-3xl md:text-5xl font-bold text-white mt-4">
                As minhas redes sociais
            </h1>

            <p class="text-slate-400 mt-4 max-w-xl mx-auto">
                Acompanha os meus projetos, explora o meu código e conecta-te comigo.
            </p>
        </header>

        {{-- CARDS --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            {{-- INSTAGRAM --}}
            <article class="group bg-slate-900 border border-slate-800 rounded-2xl p-7 text-center hover:border-pink-500 hover:-translate-y-2 transition-all duration-300 shadow-lg">
                <div class="w-16 h-16 mx-auto rounded-2xl bg-gradient-to-tr from-yellow-400 via-pink-500 to-purple-600 flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <rect x="3" y="3" width="18" height="18" rx="5" stroke-width="2"/>
                        <circle cx="12" cy="12" r="4" stroke-width="2"/>
                        <circle cx="18" cy="6" r="1" fill="currentColor" stroke="none"/>
                    </svg>
                </div>

                <h2 class="text-xl font-bold text-white mt-5">Instagram</h2>
                <p class="text-slate-400 text-sm mt-2">Conteúdos, novidades e projetos.</p>

                <a href="https://www.instagram.com/tomascustodio17/"
                   target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center justify-center gap-2 mt-6 w-full bg-pink-600 hover:bg-pink-500 text-white font-bold py-3 rounded-xl transition">
                    Go!
                    <span>↗</span>
                </a>
            </article>

            {{-- LINKEDIN --}}
            <article class="group bg-slate-900 border border-slate-800 rounded-2xl p-7 text-center hover:border-blue-500 hover:-translate-y-2 transition-all duration-300 shadow-lg">
                <div class="w-16 h-16 mx-auto rounded-2xl bg-blue-600 flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20.45 20.45h-3.56v-5.57c0-1.33-.03-3.04-1.85-3.04-1.85 0-2.13 1.45-2.13 2.94v5.67H9.35V9h3.42v1.56h.05c.48-.9 1.64-1.85 3.37-1.85 3.6 0 4.26 2.37 4.26 5.46v6.28ZM5.34 7.43a2.06 2.06 0 1 1 0-4.12 2.06 2.06 0 0 1 0 4.12ZM7.12 20.45H3.56V9h3.56v11.45ZM22.22 0H1.77C.79 0 0 .77 0 1.72v20.56C0 23.23.79 24 1.77 24h20.45c.98 0 1.78-.77 1.78-1.72V1.72C24 .77 23.2 0 22.22 0Z"/>
                    </svg>
                </div>

                <h2 class="text-xl font-bold text-white mt-5">LinkedIn</h2>
                <p class="text-slate-400 text-sm mt-2">Perfil profissional e carreira.</p>

                <a href="https://www.linkedin.com/in/tomascustodio17/"
                   target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center justify-center gap-2 mt-6 w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 rounded-xl transition">
                    Go!
                    <span>↗</span>
                </a>
            </article>

            {{-- GITHUB --}}
            <article class="group bg-slate-900 border border-slate-800 rounded-2xl p-7 text-center hover:border-slate-500 hover:-translate-y-2 transition-all duration-300 shadow-lg">
                <div class="w-16 h-16 mx-auto rounded-2xl bg-slate-700 flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 .9a11.1 11.1 0 0 0-3.51 21.63c.56.1.76-.24.76-.54v-2.1c-3.1.67-3.76-1.32-3.76-1.32-.5-1.29-1.24-1.63-1.24-1.63-1.02-.7.08-.69.08-.69 1.12.08 1.71 1.15 1.71 1.15 1 1.7 2.62 1.21 3.26.92.1-.72.39-1.21.71-1.49-2.47-.28-5.07-1.24-5.07-5.5 0-1.22.44-2.22 1.15-3-.12-.28-.5-1.42.11-2.96 0 0 .94-.3 3.05 1.15a10.6 10.6 0 0 1 5.55 0c2.11-1.45 3.05-1.15 3.05-1.15.61 1.54.23 2.68.11 2.96.72.78 1.15 1.78 1.15 3 0 4.27-2.61 5.21-5.09 5.49.4.35.75 1.02.75 2.06v3.11c0 .3.2.65.77.54A11.1 11.1 0 0 0 12 .9Z"/>
                    </svg>
                </div>

                <h2 class="text-xl font-bold text-white mt-5">GitHub</h2>
                <p class="text-slate-400 text-sm mt-2">Código-fonte e projetos.</p>

                <a href="https://github.com/Tomas-Custodio"
                   target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center justify-center gap-2 mt-6 w-full bg-slate-700 hover:bg-slate-600 text-white font-bold py-3 rounded-xl transition">
                    Go!
                    <span>↗</span>
                </a>
            </article>

            {{-- FACEBOOK --}}
            <article class="group bg-slate-900 border border-slate-800 rounded-2xl p-7 text-center hover:border-blue-400 hover:-translate-y-2 transition-all duration-300 shadow-lg">
                <div class="w-16 h-16 mx-auto rounded-2xl bg-blue-500 flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 12.07C24 5.4 18.63 0 12 0S0 5.4 0 12.07c0 6.02 4.39 11 10.13 11.93v-8.43H7.08v-3.5h3.05V9.4c0-3.03 1.8-4.7 4.54-4.7 1.31 0 2.68.24 2.68.24v2.96h-1.51c-1.49 0-1.96.93-1.96 1.88v2.29h3.34l-.53 3.5h-2.81V24C19.61 23.07 24 18.09 24 12.07Z"/>
                    </svg>
                </div>

                <h2 class="text-xl font-bold text-white mt-5">Facebook</h2>
                <p class="text-slate-400 text-sm mt-2">Publicações e contacto.</p>

                <a href="https://www.facebook.com/"
                   target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center justify-center gap-2 mt-6 w-full bg-blue-500 hover:bg-blue-400 text-white font-bold py-3 rounded-xl transition">
                    Go!
                    <span>↗</span>
                </a>
            </article>

        </div>

        {{-- RODAPÉ --}}
        <footer class="text-center mt-14 text-slate-500 text-sm">
            Desenvolvedor Laravel.
        </footer>

    </div>
</section>

@endsection