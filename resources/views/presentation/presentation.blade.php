<x-blank-layout bgClasses="bg-transparent">
    <div class="{{ $shouldHideControls ? 'hidden' : '' }} absolute top-0 right-0 flex flex-col p-3">
        <a href="?fontSize={{ $fontSize + 2 }}" class="bg-gray-200 opacity-30 hover:opacity-80 transition-opacity flex justify-center items-center w-8 h-8 rounded-t-full">
            +
        </a>
        <a href="?fontSize={{ $fontSize - 2 }}" class="bg-gray-200 opacity-30 hover:opacity-80 transition-opacity flex justify-center items-center w-8 h-8 rounded-b-full">
            -
        </a>
    </div>
    <div>
        <div class="absolute top-2 left-2 w-6 h-6">
            <svg class="w-full h-full rotate-[-90deg]" viewBox="0 0 100 100">
                <circle
                    cx="50"
                    cy="50"
                    r="40"
                    stroke="rgba(0,0,0,0.05)"
                    stroke-width="20"
                    fill="transparent"
                />
                <circle
                    id="donut-progress"
                    cx="50"
                    cy="50"
                    r="40"
                    stroke="rgba(0,0,0,0.1)"
                    stroke-width="20"
                    fill="transparent"
                    stroke-dasharray="282.74"
                    stroke-dashoffset="282.74"
                />
            </svg>
        </div>
    </div>
    <div class="mb-4">
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
                @php(
                    /**
                     * @var \App\Models\Highscore $highscore
                     */
                    $bgColor = match ($loop->iteration) {
                        1 => 'bg-yellow-300/50',
                        2 => 'bg-slate-300/50',
                        3 => 'bg-orange-300/50',
                        default => '',
                    }
                )
                <div
                    class="relative flex justify-center items-center text-right px-3 border-b border-violet-500 {{ $bgColor }}"
                >
                    @if($highscore->created_at?->isAfter(now()->subMilliseconds($refreshRate * 2)))
                        <span class="absolute top-0 -left-8 rotate-12 bg-green-600 border-green-900 text-green-100 text-xs font-bold px-2">
                            new
                        </span>
                    @endif
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
    <script>
        const refreshRate = {{ $refreshRate ?? 5000 }};
        const circle = document.getElementById('donut-progress');
        const radius = 40;
        const circumference = 2 * Math.PI * radius;

        // Initial setup
        circle.style.strokeDasharray = circumference;
        circle.style.strokeDashoffset = circumference;

        function startDonutAnimation() {
            // Step 1: Reset transition and offset instantly
            circle.style.transition = 'none';
            circle.style.strokeDashoffset = circumference;

            // Step 2: Force reflow
            requestAnimationFrame(() => {
                // Step 3: Trigger animation on next frame
                circle.style.transition = `stroke-dashoffset ${refreshRate}ms linear`;
                circle.style.strokeDashoffset = '0';
            });
        }

        startDonutAnimation();

        setInterval(() => {
            window.location = window.location.href;
        }, {{ $refreshRate }});
    </script>
</x-blank-layout>
