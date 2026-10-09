@extends("Layouts.public")

@section('content')

        <Section class="p-5 bg-slate-200">

            <h1 class="md:text-3xl"> Track list</h1>

        </Section>

    <section class="flex flex-col items-center p-9 gap-3 bg-slate-200">

       
        @foreach ($tracks as $track)

            <article class="bg-green-500 p-5 w-9/12 rounded-md shadow text-white flex flex-row items-center gap-5">

                <div class="flex flex-col gap-1 w-1/4">
                    <p class="text-lg font-bold">{{ $track['title'] }}</p>
                    <p class="text-sm">{{ $track['genre'] }}</p>
                    <p class="text-xs">{{ $track['record_label'] }}</p>
                </div>

                <audio
                    src="{{ $track['files']['mp3'] }}"
                    controls
                    class="flex-1 rounded-md">
                </audio>

                <a href="{{ route('lofy.tracks.details',Str::slug($track['id']) ) }}" class="flex items-center hover:text-slate-200 transition">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="size-6">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                    </svg>

                </a>

            </article>

        @endforeach

    </section>

@endsection

