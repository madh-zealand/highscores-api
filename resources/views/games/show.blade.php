<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My game') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5 mb-8">
                <h3 class="text-base/7 font-semibold text-gray-900">
                    {{ $game->title }}
                </h3>
                <p class="mt-1 max-w-2xl text-sm/6 text-gray-500">
                    This game has {{ $highscores->count() }} highscores
                </p>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5 mb-8">
                <h3 class="text-base/7 font-semibold text-gray-900">
                    Embedded Highscore Table
                </h3>
                <p class="mt-1 max-w-2xl text-sm/6 text-gray-500">
                    You have some options to customize your highscore table to fit your game.
                    <br>
                    If you need more customization options, you can build your own table by fetching the data from the api.
                </p>
                <hr class="my-4">
                <div class="grid grid-cols-2 gap-4">
                    <div class="h-72">
                        <div>
                            <div class="mb-3">
                                The default without setting any options.
                            </div>
                            <textarea rows="5" class="w-full h-full">
@include('embedded.highscore.partials.iframe-simple', [
    'game' => $game,
    'fontSize' => null,
    'bgColor' => null,
    'textColor' => null,
    'borderColor' => null,
])
                            </textarea>
                        </div>
                    </div>
                    <div class="h-72 border-2">
                        @include('embedded.highscore.partials.iframe-simple', [
                            'game' => $game,
                            'fontSize' => null,
                            'bgColor' => null,
                            'textColor' => null,
                            'borderColor' => null,
                        ])
                    </div>

                    <div class="h-72">
                        <div>
                            <div class="mb-3">
                                The font size can be changed with <code class="bg-gray-300 rounded-md px-2">fontSize=100</code>, where 100 is the default in percent.
                            </div>
                            <textarea rows="5" class="w-full h-full">
@include('embedded.highscore.partials.iframe-simple', [
    'game' => $game,
    'fontSize' => '60',
    'bgColor' => null,
    'textColor' => null,
    'borderColor' => null,
])
                            </textarea>
                        </div>
                    </div>
                    <div class="h-72 border-2">
                        @include('embedded.highscore.partials.iframe-simple', [
                            'game' => $game,
                            'fontSize' => '60',
                            'bgColor' => null,
                            'textColor' => null,
                            'borderColor' => null,
                        ])
                    </div>

                    <div class="h-72">
                        <div>
                            <div class="mb-3">
                                The colors can be adjusted using
                                <br>
                                <code class="bg-gray-300 rounded-md px-2">bgColor=111827</code>
                                <br>
                                <code class="bg-gray-300 rounded-md px-2">textColor=59cf8f</code>
                                <br>
                                <code class="bg-gray-300 rounded-md px-2">borderColor=3f485b</code>.
                            </div>
                            <textarea rows="5" class="w-full h-full">
@include('embedded.highscore.partials.iframe-simple', [
    'game' => $game,
    'fontSize' => null,
    'bgColor' => '111827',
    'textColor' => '59cf8f',
    'borderColor' => '3f485b',
])
                            </textarea>
                        </div>
                    </div>
                    <div class="h-72 border-2">
                        @include('embedded.highscore.partials.iframe-simple', [
                            'game' => $game,
                            'fontSize' => null,
                            'bgColor' => '111827',
                            'textColor' => '59cf8f',
                            'borderColor' => '3f485b',
                        ])
                    </div>

                </div>

            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                <div class="pb-4">
                    <h3 class="text-base/7 font-semibold text-gray-900">
                        All highscores
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm/6 text-gray-500">
                        This game has {{ $highscores->count() }} highscores
                    </p>
                </div>
                <div class="grid grid-cols-1 gap-4">
                    <div class="w-full flex-auto divide-y overflow-hidden rounded-3xl bg-white shadow-lg ring-1 ring-gray-900/5">
                        <div class="px-2 py-2 flex divide-x bg-gray-100">
                            <div class="flex flex-col items-center min-w-20">
                                <div class="mt-1 text-gray-800 text-xl font-mono font-bold">
                                    #
                                </div>
                            </div>
                            <div class="flex-1 flex flex-col items-end">
                                <div class="mt-1 mr-8 text-gray-800 text-xl font-mono font-bold">
                                    Score
                                </div>
                            </div>
                            <div class="flex-1 flex flex-col items-start">
                                <div class="mt-1 ml-8 text-gray-800 text-xl font-mono font-bold">
                                    Player
                                </div>
                            </div>
                            <div class="flex-1 flex flex-col items-center">
                                <div class="mt-1 text-gray-800 text-xl font-mono font-bold">
                                    Created
                                </div>
                            </div>
                        </div>
                        @foreach($highscores as $highscore)
                            <div class="px-2 py-2 flex divide-x">
                                <div class="flex flex-col items-center min-w-20">
                                    <div class="mt-1 text-gray-800 text-xl font-mono">
                                        {{ $loop->iteration }}
                                    </div>
                                </div>
                                <div class="flex-1 flex flex-col items-end">
                                    <div class="mt-1 mr-8 text-gray-800 text-xl font-mono">
                                        {{ $highscore->score }}
                                    </div>
                                </div>
                                <div class="flex-1 flex flex-col items-start">
                                    <div class="mt-1 ml-8 text-gray-800 text-xl font-mono">
                                        {{ $highscore->player }}
                                    </div>
                                </div>
                                <div class="flex-1 flex flex-col items-center justify-center">
                                    <div class="mt-1 text-gray-800 text-sm font-mono">
                                        {{ $highscore->created_at->toFormattedDateString() }}
                                        {{ $highscore->created_at->toTimeString() }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
