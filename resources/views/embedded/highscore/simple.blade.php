<x-embed-layout bgColor="{{ $bgColor }}">
    <div
        class="grid grid-cols-[max-content_max-content_max-content] border-t"
        style="font-size:{{ $fontSize }}%; color:#{{ $textColor }}; border-color:#{{ $borderColor }};"
    >
        @foreach($highscores as $highscore)
            <div
                class="text-right px-3 border-b"
                style="border-color:#{{ $borderColor }};"
            >
                {{ $loop->iteration }}
            </div>
            <div
                class="text-left px-3 border-b"
                style="border-color:#{{ $borderColor }};"
            >
                {{ \Illuminate\Support\Str::limit($highscore->player, 20, '...') }}
            </div>
            <div
                class="text-right px-3 border-b"
                style="border-color:#{{ $borderColor }};"
            >
                {{ $highscore->score }}
            </div>
        @endforeach
    </div>
</x-embed-layout>
