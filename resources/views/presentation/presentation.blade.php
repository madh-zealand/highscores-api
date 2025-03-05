<x-blank-layout bgColor="#ffffff">
    <div class="absolute top-0 right-0 flex flex-col p-3">
        <a href="?fontSize={{ $fontSize + 2 }}" class="bg-gray-200 opacity-30 hover:opacity-80 transition-opacity flex justify-center items-center w-8 h-8 rounded-t-full">
            +
        </a>
        <a href="?fontSize={{ $fontSize - 2 }}" class="bg-gray-200 opacity-30 hover:opacity-80 transition-opacity flex justify-center items-center w-8 h-8 rounded-b-full">
            -
        </a>
    </div>
    <div class="mb-6">
        <h1 class="text-center text-3xl font-bold">
            {{ $game->title }}
        </h1>
    </div>
    <div class="flex justify-center">
        <div
            class="font-mono grid grid-cols-[max-content_max-content_max-content] border-t border-violet-500"
            style="font-size:{{ $fontSize }}%;"
        >
            @foreach($highscores as $highscore)
                @php($bgColor = match ($loop->iteration) {
                    1 => 'bg-yellow-300/50',
                    2 => 'bg-slate-300/50',
                    3 => 'bg-orange-300/50',
                    default => '',
                })
                <div
                    class="flex justify-center items-center text-right px-3 border-b border-violet-500 {{ $bgColor }}"
                >
                    {{ $loop->iteration }}
                </div>
                <div
                    class="flex items-center text-left px-3 border-b border-violet-500 {{ $bgColor }}"
                >
                    {{ \Illuminate\Support\Str::limit($highscore->player, 20, '...') }}
                </div>
                <div
                    class="flex items-center text-right px-3 border-b border-violet-500 {{ $bgColor }}"
                >
                    {{ $highscore->score }}
                </div>
            @endforeach
        </div>
    </div>
</x-blank-layout>
